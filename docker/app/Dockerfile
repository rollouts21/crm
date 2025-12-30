FROM php:8.4-fpm

RUN apt-get update && apt-get install -y     git     libpng-dev     libjpeg-dev     libfreetype6-dev     libzip-dev     libonig-dev     unzip     zip   && docker-php-ext-configure gd --with-freetype --with-jpeg   && docker-php-ext-install -j$(nproc) pdo_mysql pdo_sqlite bcmath gd zip mbstring   && apt-get clean   && rm -rf /var/lib/apt/lists/*

COPY ./docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php --     --filename=composer     --install-dir=/usr/local/bin

WORKDIR /var/www
