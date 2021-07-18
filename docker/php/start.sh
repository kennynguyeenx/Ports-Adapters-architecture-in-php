#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then

    echo "Running the app ..."
    exec php-fpm

elif [ "$role" = "command" ]; then
    echo "Running the handle-transaction-message ..."

else
    echo "Could not match the container role \"$role\""
    exit 1
fi
