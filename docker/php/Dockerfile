FROM php:7.1-fpm

RUN apt-get update

RUN apt-get install git unzip -y
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql
