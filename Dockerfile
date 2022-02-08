FROM php:8.0.3-fpm-buster

RUN apt-get update

RUN apt-get install -y \
    zlib1g-dev \
    libzip-dev

RUN docker-php-ext-install zip

RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]