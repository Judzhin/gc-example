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

CMD ["chmod", "-R", "0775", "data/logs"]

# RUN /usr/bin/composer install --no-dev -o --no-scripts && \
#      chown -R www-data:www-data .

# For mini debug
RUN /usr/bin/composer install && \
    chown -R www-data:www-data .

USER www-data