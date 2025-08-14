# Bookstore — Installation Guide

## 1. Requirements

* **PHP**: 8.2+
* **Composer**: 2.x
* **Node.js**: 18+ (plus npm)
* **Database**: MySQL 8+ / MariaDB 10.6+
* **Git**: untuk clone project

---

## 2. Installation Steps

```bash
# 1) Clone project
git clone https://github.com/adidarma24/bookstore.git
cd bookstore

# 2) Install dependencies
composer install
npm install

# 3) Setup environment
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuai database lokal:

```dotenv
DB_DATABASE=bookstore
DB_USERNAME=root
DB_PASSWORD=secret
```

Lalu:

```bash
# 4) Migrate & seed data
php artisan migrate --seed

# 5) Jalankan server
php artisan serve
npm run dev
```

Akses di browser: [**http://127.0.0.1:8000**](http://127.0.0.1:8000)

---

## 3. Notes

* Seeder akan membuat data besar: **1,000 Author**, **3,000 Category**, **100,000 Books**, **500,000 Ratings**. Proses ini bisa memakan waktu lama.
* Jika gambar tidak muncul, jalankan:

```bash
php artisan storage:link
```

* Pastikan Node.js dan PHP versi terbaru untuk kinerja optimal.
