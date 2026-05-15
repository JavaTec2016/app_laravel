FROM tangramor/nginx-php8-fpm:latest

# Copy app files into the expected webroot
COPY . /var/www/html

WORKDIR /var/www/html

# Run composer and cache artisan configs at BUILD time
# (avoids runtime php permission issues on Render)
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
