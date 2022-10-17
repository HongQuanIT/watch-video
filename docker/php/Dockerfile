FROM php:8.1-fpm

# Install tooling we need
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        nano \
        curl \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev

# Install PHP ext
RUN docker-php-ext-configure gd && \
    docker-php-ext-install gd \
            mysqli \
            pdo \
            pdo_mysql
RUN apt-get install zip
RUN apt-get install libzip-dev -y
RUN docker-php-ext-install zip

# Install PHP ext mongodb
RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# COPY configuration
COPY config/php.ini /usr/local/etc/php/php.ini
