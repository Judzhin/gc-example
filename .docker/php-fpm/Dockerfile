FROM php:7.3-fpm-alpine as scratch

ARG APP_ENV
ENV APP_ENV=${APP_ENV}

COPY .docker/php-fpm/php_${APP_ENV}.ini /usr/local/etc/php/php.ini
COPY .docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
WORKDIR /var/www/html

# DEV env (local)
FROM scratch as dev
RUN apk --no-cache add gcc g++ autoconf make \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN apk del gcc g++ autoconf make

# PROD env (kubernetes)
FROM scratch as prod
COPY ./app/ .

RUN /usr/bin/composer install --no-dev -o --no-scripts \
    && chown -R www-data:www-data .

USER www-data