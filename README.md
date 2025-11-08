<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Employee Management REST API

This project is a RESTful API built with Laravel to manage departments, employees, and their associated contact details and addresses.

## Features
- Department CRUD operations
- Employee CRUD with multiple contacts & addresses
- Search and filtering functionality
- Built using Laravel's MVC structure and REST API best practices

## Tech Stack
- PHP 8.2
- Laravel 12
- MySQL
- Composer

## ⚙️ Setup Instructions
1. Clone this repository
    git clone https://github.com/Pandey-Narendra/employee-management-api.git

2. Navigate to the project folder
    cd employee-management-api

3. Install dependencies
    composer install

4. Copy .env and configure database
    cp .env.example .env
    php artisan key:generate

5. Run migrations
    php artisan migrate

6. Start local server
    php artisan serve
