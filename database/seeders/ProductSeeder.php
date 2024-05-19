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
                'name' => 'Acetylcysteine',
                'slug' => 'acetylcysteine',
                'code' => 'PC02',
                'quantity' => 55,
                'unit_number' => 200,
                'producttype' => 5,
                'selling_price' => 17.25,
                'quantity_alert' => 27,
                'notes' => null,
                'category_id' => 1,
                'unit_id' => 2,
                'user_id'=>1,
                'uuid'=>Str::uuid(),
            ],
            [
                'name' => 'Acetylcysteine',
                'slug' => 'acetylcysteine',
                'code' => 'PC03',
                'quantity' => 55,
                'unit_number' => 600,
                'producttype' => 5,
                'selling_price' => 17.25,
                'quantity_alert' => 27,
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
