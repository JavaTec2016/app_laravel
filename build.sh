#!/usr/bin/env bash
# Exit on error
composer install --no-dev
npm install
npm run build
php artisan config:cache
php artisan route:cache
php artisan migrate --force
