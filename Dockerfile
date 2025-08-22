# Sử dụng PHP 8.2 với Apache
FROM php:8.2-apache

# Cài extension cần thiết
RUN docker-php-ext-install pdo pdo_mysql

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy source code vào container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Cấp quyền cho storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Chạy composer install
RUN composer install --no-dev --optimize-autoloader

# Bật mod_rewrite (Laravel cần)
RUN a2enmod rewrite
COPY ./docker/apache/laravel.conf /etc/apache2/sites-available/000-default.conf
