FROM php:7.4-fpm as base

MAINTAINER kennynguyeenx@gmail.com
ARG DEBIAN_FRONTEND=noninteractive

# Install dependencies
RUN apt-get update -y \
    && apt-get install -y \
        g++ \
        libicu-dev \
        zlib1g-dev \
        libcurl4-openssl-dev \
        libssl-dev \
        --no-install-recommends \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install addition php ext
RUN docker-php-ext-install opcache mysqli \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && pecl install redis \
    && docker-php-ext-enable redis

# PHP rdkafka extensions
RUN apt-get update \
    && apt-get install -y --no-install-recommends git \
    && cd /tmp \
    && git clone \
        --branch v1.4.4 \
        --depth 1 \
        https://github.com/edenhill/librdkafka.git \
    && cd librdkafka \
    && ./configure \
    && make \
    && make install \
    && pecl install rdkafka-3.1.3 \
    && docker-php-ext-enable rdkafka \
    && rm -rf /tmp/librdkafka \
    && apt-get purge \
        -y --auto-remove \
        -o APT::AutoRemove::RecommendsImportant=false

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/php/apcu.ini /usr/local/etc/php/conf.d/apcu.ini
COPY ./docker/php/redis.ini /usr/local/etc/php/conf.d/redis.ini

ARG PUID=10000
ENV PUID ${PUID}
ARG PGID=10000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data \
    && usermod -o -u ${PUID} -g www-data www-data

FROM base as build

# Install dependencies
RUN apt-get update -y \
    && apt-get install -y \
        git \
        zip \
        unzip \
        openssh-client \
        --no-install-recommends \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --chown=www-data:www-data . /app

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /app

RUN composer install \
        --prefer-dist \
        --no-ansi \
        --no-interaction \
        --no-progress \
        --no-scripts \
        --optimize-autoloader

# Unit test
RUN chmod u+x /app/scripts/run_test.sh \
    && /app/scripts/run_test.sh

# Remove dependecies for Development
RUN composer install --no-dev  --optimize-autoloader

# Build lean image for production environment
FROM base as run

COPY --chown=www-data:www-data --from=build /app/bin/ /app/bin
COPY --chown=www-data:www-data --from=build /app/bootstrap/ /app/bootstrap
COPY --chown=www-data:www-data --from=build /app/configs/ /app/configs
COPY --chown=www-data:www-data --from=build /app/public/ /app/public
COPY --chown=www-data:www-data --from=build /app/src/ /app/src
COPY --chown=www-data:www-data --from=build /app/vendor/ /app/vendor
COPY --chown=www-data:www-data --from=build /app/init.php /app/version /app/

WORKDIR /app

COPY --chown=www-data:www-data ./docker/php/start.sh /usr/local/bin/start
RUN chmod u+x /usr/local/bin/start