<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Minimal 5 Category
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Gawai, laptop, dan komponen elektronik'],
            ['name' => 'Pakaian Pria', 'description' => 'Kemeja, kaos, dan celana pria'],
            ['name' => 'Pakaian Wanita', 'description' => 'Dress, blouse, dan rok wanita'],
            ['name' => 'Makanan & Minuman', 'description' => 'Cemilan, kopi, dan makanan instan'],
            ['name' => 'Buku', 'description' => 'Buku pelajaran, novel, dan komik'],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[] = Category::create($cat);
        }

        // 2. Buat Minimal 10 Tag
        $tags = [
            'Elektronik', 'Murah', 'Promo', 'Terlaris', 'Original', 
            'Premium', 'Katun', 'Lokal', 'Import', 'Terbaru'
        ];

        $tagModels = [];
        foreach ($tags as $tagName) {
            $tagModels[] = Tag::create(['name' => $tagName]);
        }

        // 3. Buat Minimal 20 Product (Tersebar di berbagai kategori)
        $products = [
            // Kategori Elektronik (Index 0)
            ['category_id' => $categoryModels[0]->id, 'name' => 'Laptop ASUS ROG', 'description' => 'Laptop gaming spesifikasi tinggi', 'price' => 15000000, 'stock' => 10, 'is_active' => true],
            ['category_id' => $categoryModels[0]->id, 'name' => 'Smartphone Samsung', 'description' => 'HP Android kamera jernih', 'price' => 5000000, 'stock' => 15, 'is_active' => true],
            ['category_id' => $categoryModels[0]->id, 'name' => 'Mouse Wireless Logi', 'description' => 'Mouse tanpa kabel responsif', 'price' => 250000, 'stock' => 50, 'is_active' => true],
            ['category_id' => $categoryModels[0]->id, 'name' => 'Keyboard Mechanical', 'description' => 'Keyboard RGB dengan switch biru', 'price' => 450000, 'stock' => 20, 'is_active' => true],

            // Kategori Pakaian Pria (Index 1)
            ['category_id' => $categoryModels[1]->id, 'name' => 'Kemeja Flanel Kotak', 'description' => 'Kemeja flanel bahan tebal nyaman', 'price' => 150000, 'stock' => 30, 'is_active' => true],
            ['category_id' => $categoryModels[1]->id, 'name' => 'Kaos Polos Hitam', 'description' => 'Kaos katun combed 30s', 'price' => 50000, 'stock' => 100, 'is_active' => true],
            ['category_id' => $categoryModels[1]->id, 'name' => 'Celana Chino Cream', 'description' => 'Celana panjang slimfit chino', 'price' => 180000, 'stock' => 25, 'is_active' => true],
            ['category_id' => $categoryModels[1]->id, 'name' => 'Jaket Bomber Navy', 'description' => 'Jaket bomber bahan taslan', 'price' => 220000, 'stock' => 12, 'is_active' => true],

            // Kategori Pakaian Wanita (Index 2)
            ['category_id' => $categoryModels[2]->id, 'name' => 'Blouse Ruffle Putih', 'description' => 'Blouse wanita gaya korea', 'price' => 120000, 'stock' => 40, 'is_active' => true],
            ['category_id' => $categoryModels[2]->id, 'name' => 'Dress Kebaya Modern', 'description' => 'Dress brokat untuk acara formal', 'price' => 350000, 'stock' => 8, 'is_active' => true],
            ['category_id' => $categoryModels[2]->id, 'name' => 'Rok Plisket Panjang', 'description' => 'Rok plisket bahan jatuh', 'price' => 75000, 'stock' => 60, 'is_active' => true],
            ['category_id' => $categoryModels[2]->id, 'name' => 'Cardigan Rajut Oversize', 'description' => 'Cardigan rajut tebal hangat', 'price' => 95000, 'stock' => 35, 'is_active' => true],

            // Kategori Makanan & Minuman (Index 3)
            ['category_id' => $categoryModels[3]->id, 'name' => 'Kopi Arabika Gayo 250g', 'description' => 'Biji kopi sangrai arabika gayo', 'price' => 65000, 'stock' => 45, 'is_active' => true],
            ['category_id' => $categoryModels[3]->id, 'name' => 'Keripik Singkong Pedas', 'description' => 'Cemilan keripik singkong renyah', 'price' => 15000, 'stock' => 200, 'is_active' => true],
            ['category_id' => $categoryModels[3]->id, 'name' => 'Madu Murni Alami', 'description' => 'Madu hutan asli tanpa campuran', 'price' => 110000, 'stock' => 18, 'is_active' => true],
            ['category_id' => $categoryModels[3]->id, 'name' => 'Cokelat Batangan Premium', 'description' => 'Dark chocolate kualitas lokal', 'price' => 25000, 'stock' => 80, 'is_active' => true],

            // Kategori Buku (Index 4)
            ['category_id' => $categoryModels[4]->id, 'name' => 'Buku Belajar Laravel 11', 'description' => 'Panduan lengkap membuat web', 'price' => 135000, 'stock' => 15, 'is_active' => true],
            ['category_id' => $categoryModels[4]->id, 'name' => 'Novel Fiksi Best Seller', 'description' => 'Novel cerita petualangan seru', 'price' => 90000, 'stock' => 22, 'is_active' => true],
            ['category_id' => $categoryModels[4]->id, 'name' => 'Komik Pendidikan Sains', 'description' => 'Komik edukasi untuk anak-anak', 'price' => 45000, 'stock' => 50, 'is_active' => true],
            ['category_id' => $categoryModels[4]->id, 'name' => 'Kamus Inggris-Indonesia', 'description' => 'Kamus lengkap kosakata baru', 'price' => 120000, 'stock' => 10, 'is_active' => true],
        ];

        foreach ($products as $prod) {
            $productModel = Product::create($prod);

            // 4. Hubungkan ke Tag secara RANDOM (Many to Many menggunakan attach)
            // Mengambil 2 sampai 4 tag secara acak untuk setiap produk
            $randomTagIds = collect($tagModels)->pluck('id')->random(rand(2, 4))->toArray();
            $productModel->tags()->attach($randomTagIds);
        }
    }
}