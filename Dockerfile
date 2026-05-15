# Use PHP with FPM
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nginx \
    supervisor

    # Install Node.js 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install frontend dependencies
RUN npm install

# Build Vite assets
RUN npm run build

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache

RUN sed -i 's|listen = .*|listen = 9000|' /usr/local/etc/php-fpm.d/zz-docker.conf
RUN chmod +x ./start.sh
# Copy nginx config
COPY conf/nginx/default.conf /etc/nginx/sites-available/default

# Copy supervisor config
COPY conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose Render port
EXPOSE 10000
# Start services
CMD ["./start.sh"]
