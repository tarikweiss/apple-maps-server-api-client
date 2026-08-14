FROM php:8.1-bullseye AS base

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ="Europe/Berlin"

RUN apt-get update && apt-get install -y --no-install-recommends \
    tzdata \
    software-properties-common \
    libzip-dev \
    zip \
    nano \
    grep \
    libxml2-dev \
    libonig-dev \
    libgd3 \
    zlib1g-dev \
    libpng-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install xml
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install gd
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install opcache
RUN docker-php-ext-install zip
RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /app

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Composer to the PATH
ENV PATH="$PATH:/usr/local/bin"

ENTRYPOINT ["docker-php-entrypoint"]
