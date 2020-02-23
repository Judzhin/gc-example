# FROM php:7.3-cli
#
# RUN apt-get update && apt-get install -y libpq-dev libicu-dev unzip wget \
#     && pecl install xdebug \
#     && docker-php-ext-enable xdebug
#
# COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
#
# RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet
#
# ENV COMPOSER_ALLOW_SUPERUSER 1
#
# WORKDIR /var/www

FROM php:7.3-fpm-alpine as scratch

ARG ENVIRONMENT
ENV ENVIRONMENT=${ENVIRONMENT}

COPY docker/php-fpm/php_${ENVIRONMENT}.ini /usr/local/etc/php/php.ini
COPY docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
WORKDIR /var/www

# DEV env (local)
FROM scratch as dev
RUN apk --no-cache add gcc g++ autoconf make \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN apk del gcc g++ autoconf make

# PROD env (kubernetes)
FROM scratch as prod
COPY ./app/ .

RUN /usr/bin/composer install --no-dev -o --no-scripts && \
    chown -R www-data:www-data .

ENV APP_ENV prod
USER www-data
