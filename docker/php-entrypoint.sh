#!/bin/sh

set -e

apk add --no-cache --virtual .memcached-deps zlib-dev libmemcached-dev cyrus-sasl-dev git &>/dev/null
git clone -b php7 https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached &>/dev/null
docker-php-ext-configure memcached --disable-memcached-sasl &>/dev/null
docker-php-ext-install memcached &>/dev/null
rm -rf /usr/src/php/ext/memcached

php-fpm