# Base image PHP + Apache
FROM php:8.2-apache

# Cài các extension PHP cần cho Laravel
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
RUN composer install --no-dev --optimize-autoloader

# Laravel optimize + quyền cho storage
RUN chmod -R 775 storage bootstrap/cache && \
    php artisan storage:link || true && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan cache:clear && \
    php artisan view:clear

# Apache sẽ phục vụ Laravel từ thư mục public/
EXPOSE 80

# Đảm bảo DocumentRoot = public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Thêm chỉ định index.php cho Laravel
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/conf-available/laravel.conf

RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Options Indexes FollowSymLinks\n\
        Require all granted\n\
        DirectoryIndex index.php index.html\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/laravel.conf \
&& a2ensite laravel.conf && a2dissite 000-default.conf

RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
&& a2enconf laravel

RUN a2enmod rewrite


CMD ["apache2-foreground"]
