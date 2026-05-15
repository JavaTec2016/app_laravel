#!/bin/sh
echo "ESTART"
echo "ENE PE EME"
npm install
npm run build
echo "EL ARTISANO"
php artisan config:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
exec /usr/bin/supervisord
