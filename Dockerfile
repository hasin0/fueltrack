# Use the official PHP image as the base image
FROM php

# Set the working directory
WORKDIR /var/www/html/fueltrack

# Copy the application files
COPY . .

# Install the necessary dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    curl \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Run Composer to install the PHP dependencies
RUN composer update --ignore-platform-reqs

# Set the correct permissions for the application files
RUN chown -R www-data:www-data /var/www/html/fueltrack

# Expose the necessary ports
EXPOSE 9001

# Start the PHP-FPM service
CMD php artisan serve --host=0.0.0.0 --port 9001










































# # Use the official PHP image as the base image
# FROM php

# # Set the working directory
# WORKDIR /var/www/html/fueltrack


# # Copy the application files
# COPY . .

# # Install the necessary dependencies
# RUN apt-get update && apt-get install -y \
#     build-essential \
#     libpng-dev \
#     libjpeg62-turbo-dev \
#     libfreetype6-dev \
#     locales \
#     zip \
#     jpegoptim optipng pngquant gifsicle \
#     vim \
#     libzip-dev \
#     unzip \
#     git \
#     libonig-dev \
#     curl \
#     docker-php-ext-install pdo pdo_mysql

# # Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # Run Composer to install the PHP dependencies  RUN docker-php-ext-install pdo pdo_mysql

# # RUN composer install --ignore-platform-req=ext-zip
# RUN composer update --ignore-platform-reqs

# # Set the correct permissions for the application files
# RUN chown -R www-data:www-data /var/www/html/fueltrack

# # Expose the necessary ports
# EXPOSE 9001

# # Start the PHP-FPM service
# CMD php artisan serve --host=0.0.0.0: --port 9001






























# # FROM php

# # RUN apt-get update && apt-get install -y \
# #     build-essential \
# #     libpng-dev \
# #     libjpeg62-turbo-dev \
# #     libfreetype6-dev \
# #     locales \
# #     zip \
# #     jpegoptim optipng pngquant gifsicle \
# #     vim \
# #     libzip-dev \
# #     unzip \
# #     git \
# #     libonig-dev \
# #     curl


# # RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# # WORKDIR /var/www/html/fueltrack

# # COPY composer.json .

# # RUN composer install --no-scripts

# # COPY . .

# # CMD php artisan serve --host=127.0.0.1: --port 8000
