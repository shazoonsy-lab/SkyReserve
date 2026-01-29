# Use official PHP 8.3 Apache image
FROM php:8.3-apache

# Set Apache DocumentRoot to Laravel public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY . .

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy env and generate key
RUN cp .env.example .env && php artisan key:generate

# Permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port (Render ignores this but ok to keep)
EXPOSE 10000

# Start Apache
CMD ["apache2-foreground"]
