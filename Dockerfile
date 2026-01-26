FROM php:8.2-apache-bookworm

# تفعيل rewrite
RUN a2enmod rewrite

# تثبيت Composer فقط (بدون build extensions)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# صلاحيات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

ENV COMPOSER_ALLOW_SUPERUSER=1

# Composer بدون scripts (أهم نقطة)
RUN composer install --no-dev --no-scripts --optimize-autoloader

# Document root
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80