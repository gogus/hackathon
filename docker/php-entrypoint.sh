#!/bin/sh

set -e

docker-php-ext-install pdo_mysql &>/dev/null
apk add --no-cache --virtual .memcached-deps zlib-dev libmemcached-dev cyrus-sasl-dev git
git clone -b php7 https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached
docker-php-ext-configure memcached --disable-memcached-sasl
docker-php-ext-install memcached
rm -rf /usr/src/php/ext/memcached

php-fpm