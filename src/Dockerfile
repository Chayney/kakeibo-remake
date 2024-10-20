FROM composer:latest as build
WORKDIR /app
COPY . /app
RUN composer install --no-interaction --no-progress --prefer-dist

FROM php:7.4.9-apache
WORKDIR /var/www/html

# Laravelプロジェクトをコピー
COPY --from=build /app /var/www/html

# php.iniを適切な場所にコピー
COPY ../docker/php/php.ini /usr/local/etc/php/

# 必要なPHP拡張モジュールをインストール
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev && docker-php-ext-install gd

# Apacheのドキュメントルートを設定
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80