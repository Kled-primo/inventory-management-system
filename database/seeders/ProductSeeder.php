<?php

namespace Database\Seeders;

use App\Models\Product;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = collect([
            [
                'name' => 'iPhone 14 Pro',
                'slug' => 'iphone-14-pro',
                'code' => 001,
                'quantity' => 10,
                'unit_number' => 900,
                'selling_price' => 1400,
                'quantity_alert' => 10,
                'notes' => null,
                'category_id' => 3,
                'unit_id' => 1,
                'user_id'=>1,
                'uuid'=>Str::uuid(),
            ],
            [
                'name' => 'ASUS Laptop',
                'slug' => 'asus-laptop',
                'code' => 002,
                'quantity' => 10,
                'unit_number' => 900,
                'selling_price' => 1400,
                'quantity_alert' => 10,
                'notes' => null,
                'category_id' => 1,
                'unit_id' => 2,
                'user_id'=>1,
                'uuid'=>Str::uuid(),
            ]
        ]);

        $products->each(function ($product){
            Product::create($product);
        });
    }
}
