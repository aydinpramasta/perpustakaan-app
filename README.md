<h1 align="center">Perpustakaan App</h1>

## About

Perpustakaan App adalah aplikasi e-perpustakaan berbasis web yang dibuat menggunakan bahasa pemrograman PHP dan framework Laravel.

## Prerequisites

-   PHP versi 8.0.2 ke-atas.
-   Composer versi 2 ke-atas.
-   Relational Database (MySQL, PostgreSQL, dll).

## Quick Start

```bash
git clone git@github.com:aydinpramasta/perpustakaan-app.git
cd perpustakaan-app
composer install
cp .env.example .env
```

> Sesuaikan kredensial database dengan mesin anda.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pjbl_perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

> Akses <a href="http://localhost:8000" target="_blank">http://localhost:8000</a>.
