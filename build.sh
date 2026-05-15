#!/usr/bin/env bash
# Exit on error
composer install --no-dev
php artisan config:cache
php artisan route:cache
php artisan migrate --force
npm install
npm run build
