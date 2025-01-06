<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create(['name' => 'Product A', 'price' => 10.00]);
        Product::create(['name' => 'Product B', 'price' => 15.00]);
        Product::create(['name' => 'Product C', 'price' => 20.00]);
    }
}

