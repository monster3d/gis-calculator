FROM composer:latest AS composer
FROM php:7.2.3
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt update && apt install -y git zip unzip \
    && echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini \
    && echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini

WORKDIR /app