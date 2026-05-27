# 🛍️ Toko Baru - Sistem Toko Online (Laravel 11/12)

[![Laravel Version](https://img.shields.io/badge/Laravel-11%2F12-red.svg)](https://laravel.com/)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

Repositori ini dikembangkan sebagai pemenuhan **Tugas Praktikum Pemrograman Web Advanced**. Proyek ini mencakup implementasi database relasional, migrasi skema kompleks, manajemen data awal (_seeding_), serta pengujian query tingkat lanjut menggunakan **Eloquent ORM**.

---

## 📌 Spesifikasi Proyek & Lingkungan

- **Framework:** Laravel 11 / 12 (Struktur Modern dengan PHP Attributes)
- **Bahasa Pemrograman:** PHP >= 8.2
- **Database:** MySQL / MariaDB via Laragon
- **ORM:** Laravel Eloquent (Active Record Pattern)

---

## 🛠️ Riwayat Implementasi Fitur 

### 🔹  1: Arsitektur Tabel `orders` & `order_items` 

Menambahkan sistem pencatatan transaksi belanja dengan skema database yang ternormalisasi:

1. **Tabel `orders`:** Mencatat data utama pesanan, foreign key ke tabel `users`, nominal harga, dan status menggunakan data tipe `enum` (`pending`, `paid`, `shipped`, `done`).
2. **Tabel `order_items`:** Mencatat detail item produk dalam satu pesanan (kuantitas dan harga saat transaksi).
3. **Pemetaan Relasi Model Eloquent:**
    - `User` ➡️ _hasMany_ ➡️ `Order`
    - `Order` ➡️ _hasMany_ ➡️ `OrderItem`
    - `OrderItem` ➡️ _belongsTo_ ➡️ `Product`

### 🔹  2: Otomatisasi Seeder Data 

Membuat data awal ke database agar siap digunakan untuk kebutuhan testing (_automated seed testing_) dengan kriteria:

- **`Category`:** Minimal 5 data kategori unik.
- **`Product`:** Minimal 20 data produk yang tersebar secara variatif di tiap kategori.
- **`Tag`:** Minimal 10 entitas tag.
- **Pivot Relationship:** Menghubungkan setiap produk ke 2-4 entitas tag secara acak memanfaatkan metode `attach()`.

### 🔹  3: Query Eloquent Lanjutan 

Menyelesaikan visualisasi data menggunakan sintaks Eloquent murni di dalam lingkungan **Laravel Tinker**:

1. Menampilkan **5 produk termahal** lengkap dengan nama kategorinya menggunakan teknik _Eager Loading_ (`with()`).
2. Menghitung akumulasi agregat agregasi **jumlah produk per kategori** menggunakan fungsi bawaan `withCount()`.
3. Menyaring pencarian data produk yang memiliki kriteria **tag 'Promo' dan stok tersedia (> 0)** menggunakan fungsi kompleks `whereHas()`.

---

## 🚀 Panduan Instalasi & Eksekusi Langkah demi Langkah

Ikuti urutan instruksi di bawah ini untuk menduplikasi dan menjalankan proyek pada komputer lokal Anda:

### 1. Kloning Repositori

```bash
git clone https://github.com/username/toko_baru.git
cd toko_baru
```

### 2. Instalasi Dependensi

```bash
composer install
```

### 3. Konfigurasi Lingkungan (.env)

Salin file `.env.example` menjadi `.env`, lalu sesuaikan konfigurasi database Anda (biasanya otomatis jika menggunakan Laragon):

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Eksekusi Migrasi & Penyemaian Data (Tugas 1 & Tugas 2)

Jalankan perintah mutakhir ini untuk menghapus tabel lama, memigrasikan skema baru `orders`/`order_items`, dan mengisi database melalui `ProductSeeder`:

```bash
php artisan migrate:fresh --seed
```

### 5. Pengujian Query Eloquent (Tugas 3)

Masuk ke mode interaktif Laravel Tinker:

```bash
php artisan tinker
```

Kemudian, salin dan tempel perintah-perintah berikut untuk memvalidasi data:

- **Kasus 1: 5 Produk Termahal & Kategorinya**

    ```php
    $produkTermahal = \App\Models\Product::with('category')->orderByDesc('price')->take(5)->get();
    foreach ($produkTermahal as $p) { echo "Produk: {$p->name} | Kategori: {$p->category->name} | Harga: Rp " . number_format($p->price, 0, ',', '.') . "\n"; }
    ```

- **Kasus 2: Jumlah Produk per Kategori**

    ```php
    $jumlahPerKategori = \App\Models\Category::withCount('products')->get();
    foreach ($jumlahPerKategori as $c) { echo "Kategori: {$c->name} | Jumlah Produk: {$c->products_count}\n"; }
    ```

- **Kasus 3: Produk dengan Tag 'Promo' & Stok > 0**
    ```php
    $produkPromoReady = \App\Models\Product::where('stock', '>', 0)->whereHas('tags', function ($q) { $q->where('name', 'Promo'); })->get();
    foreach ($produkPromoReady as $p) { echo "Produk: {$p->name} | Stok: {$p->stock} | Status: Ready dengan Tag Promo\n"; }
    ```

---

## 📂 Struktur Source Code Utama

```text
toko_baru/
├── app/
│   └── Models/
│       ├── Category.php     # hasMany ke Product
│       ├── Order.php        # belongsTo User, hasMany OrderItem
│       ├── OrderItem.php    # belongsTo Order, belongsTo Product
│       ├── Product.php      # belongsTo Category, belongsToMany Tag
│       ├── Tag.php          # belongsToMany Product
│       └── User.php         # hasMany Order, hasOne Profile
├── database/
│   ├── migrations/
│   │   ├── 2026_05_26_162018_create_orders_table.php
│   │   └── 2026_05_26_162029_create_order_items_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php   # Memanggil ProductSeeder
│       └── ProductSeeder.php   # Logika input otomatis 5 Cat, 20 Prod, 10 Tag
```

---

## 📝 Lisensi & Penggunaan Akademik

Proyek ini dikembangkan khusus untuk kebutuhan praktikum dan pembelajaran mata kuliah **Pemrograman Web Advanced / Pemrograman Web Berbasis Framework** pada Tahun Ajaran **2025/2026**.

Seluruh source code di dalam repositori ini dapat digunakan sebagai:

- Media pembelajaran dan referensi akademik
- Bahan eksplorasi implementasi Laravel Eloquent ORM
- Contoh penerapan relasi database dan query tingkat lanjut
- Sarana pengembangan kemampuan backend berbasis framework Laravel

Diperbolehkan untuk memodifikasi, mempelajari, dan mengembangkan proyek ini lebih lanjut untuk kepentingan edukasi dengan tetap mencantumkan atribusi kepada pengembang asli.

> © 2026 — Praktikum Pemrograman Web Advanced  
> Dibangun menggunakan Laravel 11/12 dan MySQL untuk kebutuhan pembelajaran akademik.
