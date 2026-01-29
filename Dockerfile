# استخدم صورة PHP مع Apache
FROM php:8.3-apache

# ⭐ Laravel public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# اضبط Apache ليستخدم public كـ DocumentRoot
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# استبدل Listen بالـ PORT من Render
ARG PORT
RUN sed -ri 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf

# تفعيل mod_rewrite (ضروري لروابط Laravel)
RUN a2enmod rewrite

# إنشاء مجلد العمل
WORKDIR /var/www/html

# تثبيت التبعيات للنظام + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# نسخ ملفات المشروع
COPY . .

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# إعداد .env و key
RUN cp .env.example .env && php artisan key:generate

# ضبط الصلاحيات (ضروري لتجنب مشاكل 403)
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose PORT (يجب أن يتوافق مع Render)
EXPOSE ${PORT}

# تشغيل Apache في foreground
CMD ["apache2-foreground"]
