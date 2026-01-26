FROM richarvey/nginx-php-fpm:8.2

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R nginx:nginx /var/www/html \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 80