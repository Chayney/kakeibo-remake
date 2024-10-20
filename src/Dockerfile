FROM composer:latest as build
WORKDIR /app
COPY . /app
RUN composer install

FROM php:7.4.9-apache
COPY --from=build /app /var/www/html
COPY docker/php/php.ini /usr/local/etc/php/php.ini
RUN apt update && apt install -y libpng-dev libjpeg-dev && docker-php-ext-install gd
EXPOSE 8080