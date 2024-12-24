<p align="center">
    <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>
    <a href="https://my.payos.vn" target="_blank"><img src="https://payos.vn/docs/img/logo.svg" width="300" alt="PayOS"></a>
</p>

<p align="center">
<a href="https://github.com/vanthien2704/shop-onlne/archive/refs/heads/main.zip"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
</p>

# Online Shop
A php laravel sales website using PayOS payment method
## Technologies
- Laravel 11
- PHP 8.2
- PayOS
## Prerequisites
- PHP 8.2 or later
- MySQL / MariaDB
## Installation
- Edit database connection in .env file.
``` env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shopthethao
DB_USERNAME=root
DB_PASSWORD=
````
- Edit payos connection in .env file.
``` env
PAYOS_CLIENT_ID=""
PAYOS_SECRET=""
PAYOS_API_KEY=""
````
- Create databse, seed data
```console
php artisan migrate
```
```console
php artisan db:seed
```


