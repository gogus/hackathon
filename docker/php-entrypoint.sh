#!/bin/sh

set -e

docker-php-ext-install pdo_mysql &>/dev/null

php-fpm