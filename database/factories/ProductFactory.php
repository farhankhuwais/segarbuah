<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected static array $products = [
        ['name' => 'Bayam Hijau', 'unit' => 'ikat', 'weight' => 250, 'origin' => 'Lembang, Jawa Barat', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di kulkas, bungkus dengan kertas', 'min_order' => 1, 'price' => 5000, 'compare' => 6000],
        ['name' => 'Kangkung', 'unit' => 'ikat', 'weight' => 200, 'origin' => 'Bogor, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam keadaan kering', 'min_order' => 1, 'price' => 4000, 'compare' => null],
        ['name' => 'Sawi Putih', 'unit' => 'buah', 'weight' => 500, 'origin' => 'Cipanas, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di chiller kulkas', 'min_order' => 1, 'price' => 7000, 'compare' => 8500],
        ['name' => 'Wortel Import', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Australia', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas, jangan dicuci sebelum disimpan', 'min_order' => 0.5, 'price' => 25000, 'compare' => 30000],
        ['name' => 'Kentang Merah', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Malino, Sulawesi Selatan', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di tempat kering dan gelap', 'min_order' => 0.5, 'price' => 18000, 'compare' => 22000],
        ['name' => 'Tomat Merah', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Cisarua, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan pada suhu ruang, jangan di kulkas', 'min_order' => 0.5, 'price' => 15000, 'compare' => 18000],
        ['name' => 'Cabai Merah Besar', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Kediri, Jawa Timur', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam wadah tertutup', 'min_order' => 0.25, 'price' => 45000, 'compare' => 55000],
        ['name' => 'Bawang Merah', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Brebes, Jawa Tengah', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di tempat kering dan berventilasi', 'min_order' => 0.25, 'price' => 35000, 'compare' => 40000],
        ['name' => 'Bawang Putih', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Tegal, Jawa Tengah', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di tempat kering dan gelap', 'min_order' => 0.25, 'price' => 30000, 'compare' => null],
        ['name' => 'Mangga Harum Manis', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Probolinggo, Jawa Timur', 'organic' => true, 'seasonal' => true, 'storage' => 'Simpan pada suhu ruang hingga matang', 'min_order' => 1, 'price' => 35000, 'compare' => 45000],
        ['name' => 'Pisang Ambon', 'unit' => 'sisir', 'weight' => 750, 'origin' => 'Lampung', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan pada suhu ruang', 'min_order' => 1, 'price' => 20000, 'compare' => null],
        ['name' => 'Pepaya California', 'unit' => 'buah', 'weight' => 800, 'origin' => 'Magelang, Jawa Tengah', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan pada suhu ruang hingga matang, lalu kulkas', 'min_order' => 1, 'price' => 15000, 'compare' => 18000],
        ['name' => 'Apel Fuji', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'China', 'organic' => false, 'seasonal' => true, 'storage' => 'Simpan di kulkas untuk kesegaran lebih lama', 'min_order' => 0.5, 'price' => 40000, 'compare' => 50000],
        ['name' => 'Anggur Merah', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Australia', 'organic' => false, 'seasonal' => true, 'storage' => 'Simpan di kulkas, jangan dicuci sebelum dimakan', 'min_order' => 0.5, 'price' => 55000, 'compare' => 65000],
        ['name' => 'Jeruk Nipis', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Bali', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam wadah kedap udara', 'min_order' => 0.25, 'price' => 20000, 'compare' => 25000],
        ['name' => 'Selada Hijau', 'unit' => 'buah', 'weight' => 300, 'origin' => 'Lembang, Jawa Barat', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di chiller kulkas dengan tisu basah', 'min_order' => 1, 'price' => 8000, 'compare' => 10000],
        ['name' => 'Timun Jepang', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Cianjur, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik', 'min_order' => 0.5, 'price' => 12000, 'compare' => null],
        ['name' => 'Terong Ungu', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Pandeglang, Banten', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di suhu ruang, gunakan dalam 2-3 hari', 'min_order' => 0.5, 'price' => 10000, 'compare' => 13000],
        ['name' => 'Jahe Merah', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Ciamis, Jawa Barat', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di tempat kering dan gelap', 'min_order' => 0.25, 'price' => 28000, 'compare' => 35000],
        ['name' => 'Kunyit Segar', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Ciamis, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik', 'min_order' => 0.25, 'price' => 15000, 'compare' => null],
        ['name' => 'Sereh', 'unit' => 'ikat', 'weight' => 100, 'origin' => 'Sukabumi, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Bungkus dengan plastik dan simpan di kulkas', 'min_order' => 1, 'price' => 3000, 'compare' => 4000],
        ['name' => 'Daun Bawang', 'unit' => 'ikat', 'weight' => 100, 'origin' => 'Cipanas, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam gelas berisi air', 'min_order' => 1, 'price' => 3000, 'compare' => null],
        ['name' => 'Brokoli', 'unit' => 'buah', 'weight' => 350, 'origin' => 'Cisarua, Jawa Barat', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik berlubang', 'min_order' => 1, 'price' => 12000, 'compare' => 15000],
        ['name' => 'Kol/Kubis', 'unit' => 'buah', 'weight' => 800, 'origin' => 'Cipanas, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik', 'min_order' => 1, 'price' => 8000, 'compare' => 10000],
        ['name' => 'Alpukat Mentega', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Bogor, Jawa Barat', 'organic' => true, 'seasonal' => true, 'storage' => 'Simpan pada suhu ruang hingga matang', 'min_order' => 0.5, 'price' => 35000, 'compare' => 42000],
        ['name' => 'Semangka Merah', 'unit' => 'buah', 'weight' => 3000, 'origin' => 'Wonogiri, Jawa Tengah', 'organic' => false, 'seasonal' => true, 'storage' => 'Simpan di suhu ruang, simpan di kulkas setelah dipotong', 'min_order' => 1, 'price' => 25000, 'compare' => 35000],
        ['name' => 'Melon Golden', 'unit' => 'buah', 'weight' => 1500, 'origin' => 'Kulon Progo, DI Yogyakarta', 'organic' => false, 'seasonal' => true, 'storage' => 'Simpan pada suhu ruang hingga matang', 'min_order' => 1, 'price' => 28000, 'compare' => null],
        ['name' => 'Kelapa Muda', 'unit' => 'buah', 'weight' => 800, 'origin' => 'Jawa Tengah', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas, nikmati dalam 2-3 hari', 'min_order' => 1, 'price' => 10000, 'compare' => 12000],
        ['name' => 'Nanas Madu', 'unit' => 'buah', 'weight' => 1000, 'origin' => 'Subang, Jawa Barat', 'organic' => false, 'seasonal' => true, 'storage' => 'Simpan pada suhu ruang, kupas dan simpan di kulkas setelah dipotong', 'min_order' => 1, 'price' => 18000, 'compare' => null],
        ['name' => 'Terong Bulat', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Pandeglang, Banten', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di suhu ruang', 'min_order' => 0.5, 'price' => 11000, 'compare' => 14000],
        ['name' => 'Daun Singkong', 'unit' => 'ikat', 'weight' => 200, 'origin' => 'Bogor, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik', 'min_order' => 1, 'price' => 3000, 'compare' => null],
        ['name' => 'Kacang Panjang', 'unit' => 'ikat', 'weight' => 200, 'origin' => 'Cianjur, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik', 'min_order' => 1, 'price' => 5000, 'compare' => 6000],
        ['name' => 'Buncis', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Lembang, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik', 'min_order' => 0.5, 'price' => 14000, 'compare' => 17000],
        ['name' => 'Labu Siam', 'unit' => 'buah', 'weight' => 500, 'origin' => 'Cipanas, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di suhu ruang, tahan hingga seminggu', 'min_order' => 1, 'price' => 6000, 'compare' => null],
        ['name' => 'Jagung Manis', 'unit' => 'buah', 'weight' => 300, 'origin' => 'Pasuruan, Jawa Timur', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dengan kulitnya', 'min_order' => 1, 'price' => 7000, 'compare' => 8500],
        ['name' => 'Pakcoy', 'unit' => 'ikat', 'weight' => 250, 'origin' => 'Lembang, Jawa Barat', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di chiller kulkas', 'min_order' => 1, 'price' => 6000, 'compare' => 7500],
        ['name' => 'Sawi Hijau', 'unit' => 'ikat', 'weight' => 250, 'origin' => 'Cipanas, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam keadaan kering', 'min_order' => 1, 'price' => 4500, 'compare' => null],
        ['name' => 'Kiwi Gold', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Selandia Baru', 'organic' => true, 'seasonal' => true, 'storage' => 'Simpan di kulkas, biarkan matang pada suhu ruang', 'min_order' => 0.5, 'price' => 65000, 'compare' => 80000],
        ['name' => 'Stroberi Fresh', 'unit' => 'pack', 'weight' => 500, 'origin' => 'Ciwidey, Jawa Barat', 'organic' => true, 'seasonal' => true, 'storage' => 'Simpan di kulkas, jangan dicuci sebelum disimpan', 'min_order' => 1, 'price' => 35000, 'compare' => 45000],
        ['name' => 'Lemon', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Bali', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam wadah kedap udara', 'min_order' => 0.5, 'price' => 30000, 'compare' => null],
        ['name' => 'Paket Sayur Sop', 'unit' => 'pack', 'weight' => 500, 'origin' => 'Lembang, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas, konsumsi dalam 2 hari', 'min_order' => 1, 'price' => 15000, 'compare' => 20000],
        ['name' => 'Paket Lalapan', 'unit' => 'pack', 'weight' => 400, 'origin' => 'Cianjur, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas, konsumsi dalam 1-2 hari', 'min_order' => 1, 'price' => 12000, 'compare' => null],
        ['name' => 'Paket Buah Segar', 'unit' => 'pack', 'weight' => 2000, 'origin' => 'Nusantara', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan buah di suhu ruang untuk yang belum matang', 'min_order' => 1, 'price' => 50000, 'compare' => 65000],
        ['name' => 'Cabai Rawit', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Madura, Jawa Timur', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam wadah tertutup', 'min_order' => 0.25, 'price' => 55000, 'compare' => 70000],
        ['name' => 'Singkong', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Wonogiri, Jawa Tengah', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di tempat kering dan gelap', 'min_order' => 0.5, 'price' => 8000, 'compare' => null],
        ['name' => 'Ubi Cilembu', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Cilembu, Jawa Barat', 'organic' => true, 'seasonal' => true, 'storage' => 'Simpan di tempat kering dan gelap, jangan di kulkas', 'min_order' => 0.5, 'price' => 20000, 'compare' => 25000],
        ['name' => 'Tauge', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Jakarta', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam wadah berisi air, ganti air setiap hari', 'min_order' => 0.25, 'price' => 12000, 'compare' => null],
        ['name' => 'Lobak Putih', 'unit' => 'buah', 'weight' => 400, 'origin' => 'Cipanas, Jawa Barat', 'organic' => false, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik', 'min_order' => 1, 'price' => 8000, 'compare' => 10000],
        ['name' => 'Pir Hijau', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'China', 'organic' => false, 'seasonal' => true, 'storage' => 'Simpan di kulkas untuk kesegaran lebih lama', 'min_order' => 0.5, 'price' => 38000, 'compare' => 45000],
        ['name' => 'Belimbing', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Depok, Jawa Barat', 'organic' => false, 'seasonal' => true, 'storage' => 'Simpan pada suhu ruang', 'min_order' => 0.5, 'price' => 15000, 'compare' => null],
        ['name' => 'Jambu Kristal', 'unit' => 'kg', 'weight' => 1000, 'origin' => 'Mojokerto, Jawa Timur', 'organic' => true, 'seasonal' => false, 'storage' => 'Simpan di kulkas dalam plastik', 'min_order' => 0.5, 'price' => 25000, 'compare' => 30000],
    ];

    public function definition(): array
    {
        $product = $this->faker->unique()->randomElement(static::$products);

        return [
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? 1,
            'name' => $product['name'],
            'slug' => \Illuminate\Support\Str::slug($product['name']),
            'description' => "{$product['name']} segar langsung dari {$product['origin']}. " . $this->faker->sentence(),
            'price' => $product['price'],
            'compare_price' => $product['compare'],
            'stock' => $this->faker->numberBetween(10, 200),
            'sku' => 'SB-' . strtoupper($this->faker->bothify('??###')),
            'unit' => $product['unit'],
            'weight_in_grams' => $product['weight'],
            'origin' => $product['origin'],
            'is_organic' => $product['organic'],
            'is_seasonal' => $product['seasonal'],
            'storage_info' => $product['storage'],
            'min_order' => $product['min_order'],
            'is_active' => true,
            'is_featured' => $this->faker->boolean(30),
        ];
    }
}
