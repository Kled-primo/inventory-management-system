<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $producttype = collect([
            [
                'id'    => 1,
                'name' => 'Capsule',
                'slug' => 'capsule',
                'user_id'=>1
            ],
            [
                'id'    => 2,
                'name' => 'Drops',
                'slug' => 'drops',
                'user_id'=>1
            ],
            [
                'id'    => 3,
                'name' => 'Powder',
                'slug' => 'powder',
                'user_id'=>1
            ],
            [
                'id'    => 4,
                'name' => 'Suspension',
                'slug' => 'suspension',
                'user_id'=>1
            ],
            [
                'id'    => 5,
                'name' => 'Syrup',
                'slug' => 'syrup',
                'user_id'=>1
            ],
            [
                'id'    => 6,
                'name' => 'Tablet',
                'slug' => 'tablet',
                'user_id'=>1
            ]
        ]);

        $producttypes->each(function ($producttype){
            ProductType::insert($producttype);
        });
    }
}
