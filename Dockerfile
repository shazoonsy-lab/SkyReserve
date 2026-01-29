FROM php:8.3-apache
# Render Apache PORT fix

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

# Enable Apache rewrite
RUN a2enmod rewrite

# Change Apache to listen on Render PORT
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf && \
    sed -ri 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf

# Copy project
COPY . .

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Env & key
RUN cp .env.example .env && php artisan key:generate

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Start Apache
CMD ["apache2-foreground"]
