#!/usr/bin/env bash
cd $(dirname $0)
export ROOT_FOLDER=$(pwd)/..
php ${ROOT_FOLDER}/vendor/phpunit/phpunit/phpunit ${ROOT_FOLDER}/tests/Unit \
    --configuration ${ROOT_FOLDER}/phpunit.xml \
    --coverage-html ${ROOT_FOLDER}/phpunit_coverage \
    --whitelist ${ROOT_FOLDER}/src