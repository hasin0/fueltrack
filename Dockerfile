# Use the official PHP image as the base image
FROM php:alpine

# Set the working directory
WORKDIR /var/www/html/fueltrack

# Install the necessary dependencies and extensions
RUN apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    jpegoptim optipng pngquant gifsicle \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring bcmath

# Copy the application files including .env.example
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Run Composer to install the PHP dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Setup environment and permissions
RUN cp .env.example .env && \
    php artisan key:generate && \
    chmod -R 777 /var/www/html/fueltrack

# Expose the necessary ports
EXPOSE 9001

# Start the PHP-FPM service
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9001"]
