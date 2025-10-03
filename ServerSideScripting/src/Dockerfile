FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install mysqli, pdo, pdo_mysql and xdebug
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli \
    && pecl install xdebug && docker-php-ext-enable xdebug

COPY php.ini /usr/local/etc/php/conf.d/