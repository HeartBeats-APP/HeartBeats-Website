FROM php:8.0.3-apache

# Update repositories and install Apache
RUN echo "deb http://deb.debian.org/debian/ oldoldstable main" > /etc/apt/sources.list && \
    echo "deb http://security.debian.org/debian-security oldoldstable/updates main" >> /etc/apt/sources.list && \
    apt-get update && \
    apt-get install -y apache2 && \
    a2enmod rewrite && \
    a2enmod headers


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

# Install curl libraries
RUN apt-get install -y curl && apt-get clean -y
RUN service apache2 restart

FROM mariadb:10.11.3
CMD [ "--max_connections=10000" ]