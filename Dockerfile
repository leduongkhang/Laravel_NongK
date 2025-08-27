# Base image PHP + Apache
FROM php:8.2-apache

# Cài extension PHP cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring bcmath

# Bật Apache mod_rewrite cho Laravel route
RUN a2enmod rewrite

# Cài Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set thư mục làm việc
WORKDIR /var/www/html

# Copy toàn bộ code vào container
COPY . .

# Cài đặt Laravel dependencies (không lấy dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Laravel optimize (không bắt lỗi khi lần đầu chạy)
RUN php artisan config:clear || true && \
    php artisan route:clear || true && \
    php artisan cache:clear || true && \
    php artisan view:clear || true && \
    php artisan storage:link || true

# Fix quyền cho storage & cache (Apache user: www-data)
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Cấu hình Apache DocumentRoot -> public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Tạo VirtualHost Laravel
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Options Indexes FollowSymLinks\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/laravel.conf \
&& a2ensite laravel.conf && a2dissite 000-default.conf

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
