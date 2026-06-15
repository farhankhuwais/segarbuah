<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected static array $categories = [
        ['name' => 'Sayuran Daun', 'description' => 'Bayam, kangkung, sawi, selada, dan berbagai sayuran daun segar'],
        ['name' => 'Sayuran Umbi', 'description' => 'Kentang, wortel, bawang, singkong, dan umbi-umbian segar'],
        ['name' => 'Sayuran Buah', 'description' => 'Tomat, terong, cabai, timun, labu dan sayuran buah lainnya'],
        ['name' => 'Buah Lokal', 'description' => 'Mangga, pisang, pepaya, jeruk lokal, dan buah nusantara'],
        ['name' => 'Buah Impor', 'description' => 'Apel, anggur, kiwi, stroberi, dan buah impor segar'],
        ['name' => 'Herbal & Rempah', 'description' => 'Jahe, kunyit, sereh, daun bawang, dan bumbu dapur segar'],
        ['name' => 'Organik', 'description' => 'Sayur dan buah organik tanpa pestisida, lebih sehat'],
        ['name' => 'Paket Hemat', 'description' => 'Paket combo sayur dan buah dengan harga spesial'],
    ];

    public function definition(): array
    {
        $category = $this->faker->unique()->randomElement(static::$categories);

        return [
            'name' => $category['name'],
            'slug' => \Illuminate\Support\Str::slug($category['name']),
            'description' => $category['description'],
            'is_active' => true,
        ];
    }
}
