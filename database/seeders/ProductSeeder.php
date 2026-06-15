<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::factory(50)->create();

        $ids = [1, 2, 3, 4];
        foreach ($ids as $id) {
            $p = \App\Models\Product::find($id);
            if ($p) {
                $p->update([
                    'sale_price' => $p->price * 0.7,
                    'sale_starts_at' => now(),
                    'sale_ends_at' => now()->addHours(8),
                ]);
            }
        }
    }
}
