<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Classic Silver',
                'description' => 'Elegant stainless steel watch with minimalist dial.',
                'price' => 24999.00,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
            ],
            [
                'name' => 'Midnight Pro',
                'description' => 'Dark premium finish with luminous hour markers.',
                'price' => 31999.00,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1547996160-81dfa63595aa?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
            ],
            [
                'name' => 'Royal Gold',
                'description' => 'Bold gold-tone body for formal and special events.',
                'price' => 42999.00,
                'stock' => 9,
                'image' => 'https://images.unsplash.com/photo-1494578379344-5af9f0c1f7c1?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
            ],
            [
                'name' => 'Sport Edge',
                'description' => 'Sport-friendly timepiece built for active routines.',
                'price' => 21999.00,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => false,
            ],
            [
                'name' => 'Urban Steel',
                'description' => 'Daily wear watch with robust steel construction.',
                'price' => 27999.00,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1614164185128-e4ec99c436d7?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => false,
            ],
            [
                'name' => 'Ocean Blue',
                'description' => 'Fresh blue dial inspired by oceanic tones.',
                'price' => 25999.00,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1514041603567-3af8a1c9c0c9?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
            ],
        ];

        foreach ($products as $entry) {
            Product::query()->updateOrCreate(
                ['slug' => Str::slug($entry['name'])],
                $entry + ['slug' => Str::slug($entry['name'])]
            );
        }
    }
}
