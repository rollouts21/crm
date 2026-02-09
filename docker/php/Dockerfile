FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    bash git unzip zip icu-dev oniguruma-dev libzip-dev \
    postgresql-dev

RUN docker-php-ext-configure intl \
 && docker-php-ext-install -j$(nproc) intl mbstring zip pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-custom.ini
COPY docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm", "-F"]
