FROM php:8.2-apache

# Apache config
RUN a2enmod rewrite

# تثبيت متطلبات PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# صلاحيات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

ENV COMPOSER_ALLOW_SUPERUSER=1

# تثبيت Composer بدون scripts
RUN composer install --no-dev --no-scripts --optimize-autoloader

# توجيه Apache إلى public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80