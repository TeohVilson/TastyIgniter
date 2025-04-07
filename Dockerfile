# Use an official PHP runtime as a parent image
FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Install dependencies with Composer
RUN composer install

# Expose port 9000
EXPOSE 9000

CMD ["php-fpm"]
