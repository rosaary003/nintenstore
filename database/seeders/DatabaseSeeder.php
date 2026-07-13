<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Product::firstOrCreate(
            ['name' => 'Super Mario Bros. Wonder'],
            [
                'category' => 'Adventure',
                'description' => 'Petualangan seru Mario di Flower Kingdom',
                'price' => 650000,
                'stock' => 10,
                'image' => 'mario-wonder.jpg',
            ]
        );
    }
}