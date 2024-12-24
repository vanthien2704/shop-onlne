#!/bin/bash
rm -f app.tar.gz
composer install --no-dev --optimize-autoloader
php artisan optimize:clear
rm -f storage/logs/laravel.log
rm -rf storage/framework/sessions/*
tar --exclude=node_modules --exclude=dump --exclude=public/assets --exclude=public/assetsadmin --exclude=public/upload -czf ./app.tar.gz * .env.example
composer i