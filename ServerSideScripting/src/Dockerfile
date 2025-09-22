FROM php:8.2-apache

# Install mysqli and xdebug
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli \
    && pecl install xdebug && docker-php-ext-enable xdebug    http://localhost:8080/Week%203/midterm_setup.php

COPY php.ini /usr/local/etc/php/conf.d/