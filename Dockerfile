FROM php:8.2-fpm AS base

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip unzip \
  && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy app and install dependencies at BUILD time
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html/storage \
  && chmod -R 755 /var/www/html/bootstrap/cache

# Cache at build time (requires APP_KEY etc — skip if you don't have them at build time)
# RUN php artisan config:cache
# RUN php artisan route:cache
# RUN php artisan view:cache

# Nginx config
COPY docker/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
