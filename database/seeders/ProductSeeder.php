<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'image' => ''
            ],
            [
                'category_id' => 2,
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'image' => ''
            ],
            [
                'category_id' => 3,
                'name' => 'Product 3',
                'description' => 'Description for Product 3',
                'image' => ''
            ],
            [
                'category_id' => 4,
                'name' => 'Product 4',
                'description' => 'Description for Product 4',
                'image' => ''
            ],
            [
                'category_id' => 5,
                'name' => 'Product 5',
                'description' => 'Description for Product 5',
                'image' => ''
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
