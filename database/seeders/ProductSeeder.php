<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Paracetamol 500mg',
                'description' => 'Pain relief tablet',
                'price' => 5.00,
                'stock' => 100,
                'image' => null,
                'category' => 'Pills',
            ],
            [
                'name' => 'Vitamin C 1000mg',
                'description' => 'Immune booster supplement',
                'price' => 12.50,
                'stock' => 50,
                'image' => null,
                'category' => 'Pills',
            ],
            [
                'name' => 'Digital Thermometer',
                'description' => 'Fast and accurate temperature measurement',
                'price' => 25.00,
                'stock' => 20,
                'image' => null,
                'category' => 'Devices',
            ],
            [
                'name' => 'Blood Pressure Monitor',
                'description' => 'Automatic blood pressure monitor',
                'price' => 65.00,
                'stock' => 15,
                'image' => null,
                'category' => 'Devices',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
