FROM php:8.1 AS base

RUN apt update && apt install tzdata -y

ENV TZ="Europe/Berlin"

RUN apt update && apt upgrade -y && apt install -y software-properties-common

RUN apt install -y \
    zip \
    nano \
    grep \
    libxml2-dev \
    libonig-dev \
    libgd3 \
    zlib1g-dev \
    libpng-dev

RUN docker-php-ext-install xml
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install gd
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install opcache
RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /app

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Composer to the PATH
ENV PATH="$PATH:/usr/local/bin"

ENTRYPOINT ["docker-php-entrypoint"]
