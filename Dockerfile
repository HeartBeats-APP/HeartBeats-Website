FROM php:8.0.3-apache

# Enbable the rewrite engine
RUN a2enmod rewrite

# Install SQL drivers
RUN docker-php-ext-install mysqli pdo pdo_mysql