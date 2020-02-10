FROM php:7.3-fpm

RUN apt-get update && apt-get install -y libpq-dev libicu-dev unzip wget \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www
