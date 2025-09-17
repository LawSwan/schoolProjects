# Use PHP 8.2 with Apache (multi-arch, works on ARM Macs)
FROM php:8.2-apache

# Install system tools and mysqli extension
RUN apt-get update && apt-get install -y git unzip autoconf make gcc g++ pkg-config \
 && docker-php-ext-install mysqli

# Install and enable Xdebug
RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

# Configure Xdebug
RUN echo "xdebug.mode=debug\n\
xdebug.start_with_request=yes\n\
xdebug.client_host=host.docker.internal\n\
xdebug.client_port=9003" \
    > /usr/local/etc/php/conf.d/xdebug.ini