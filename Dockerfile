# Base image PHP + Apache
FROM php:8.2-apache

# Cài các extension PHP cần cho Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Cài Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ code vào container
COPY . .

# Cài đặt Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix quyền cho storage và cache
RUN chmod -R 775 storage bootstrap/cache

# Tạo storage link & clear cache
RUN php artisan storage:link || true
RUN php artisan config:clear && php artisan route:clear && php artisan cache:clear

# Apache sẽ phục vụ Laravel từ thư mục public/
EXPOSE 80
CMD ["apache2-foreground"]
