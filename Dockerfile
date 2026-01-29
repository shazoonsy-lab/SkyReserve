FROM php:8.3-apache

# ⭐ Laravel public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update Apache config to use public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Render PORT
RUN sed -ri 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf

WORKDIR /var/www/html

# System deps
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

RUN a2enmod rewrite

# Copy project
COPY . .

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Env + key
RUN cp .env.example .env && php artisan key:generate

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000
CMD ["apache2-foreground"]
