#!/bin/sh
echo "EL ARTISANO"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
exec /usr/bin/supervisord
