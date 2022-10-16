<h1 align="center">Perpustakaan App</h1>

## About

Perpustakaan App adalah aplikasi e-perpustakaan berbasis web yang dibuat menggunakan bahasa pemrograman PHP dan framework Laravel.

## Prerequisites

-   PHP versi 8.0.2 ke-atas.
-   Composer versi 2 ke-atas.
-   Relational Database (MySQL, PostgreSQL, dll).
-   NPM versi 8 ke-atas.

## Quick Start

```bash
git clone git@github.com:aydinpramasta/perpustakaan-app.git
cd perpustakaan-app
composer install
npm install
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

npm run dev
```

> Buka terminal baru.

```bash
php artisan serve
```

> Akses [http://localhost:8000](http://localhost:8000).
