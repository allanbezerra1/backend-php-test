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
            'code' => 'Teste1',
            'name' => 'Teste1',
            'price' => 1.89,
            'available_quantity' => 150,
            'brand' => 'testeBrand'
        ]);

        Product::create([
            'code' => 'Teste2',
            'name' => 'Teste2',
            'price' => 1.97,
            'available_quantity' => 189,
            'brand' => 'testeBrand'
        ]);
    }
}
