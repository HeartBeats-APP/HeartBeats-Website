FROM php:8.0.3-apache

# Enbable the rewrite engine
RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd

# Install SQL drivers
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN service apache2 restart