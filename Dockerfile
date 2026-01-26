FROM php:8.2-apache

# تثبيت المتطلبات
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# تفعيل Apache rewrite
RUN a2enmod rewrite

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# مجلد العمل
WORKDIR /var/www/html

# نسخ المشروع
COPY . .

# صلاحيات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# السماح لـ Composer بالعمل كـ root
ENV COMPOSER_ALLOW_SUPERUSER=1

# تثبيت الحزم
RUN composer install --no-dev --optimize-autoloader

# ضبط DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80