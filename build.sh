#!/usr/bin/env bash
# Exit on error
composer install --no-dev --optimize-autoloader
npm install --omit=dev
npm run build
