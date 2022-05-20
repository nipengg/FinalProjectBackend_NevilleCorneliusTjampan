<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'MacBook Pro',
            'price' => 2499.99,
            'shipping_cost' => 29.99,
            'quantity' => 10,
            'category_id' => 1,
            'image' => 'macbook-pro.png'
        ]);

        Product::create([
            'name' => 'Dell Vostro 3557',
            'price' => 1499.99,
            'shipping_cost' => 19.99,
            'quantity' => 20,
            'category_id' => 1,
            'image' => 'dell-v3557.png'
        ]);
    }
}
