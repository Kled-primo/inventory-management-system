<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $producttypes = collect([
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
                'name' => 'Lozenge',
                'slug' => 'lozenge',
                'user_id'=>1
            ],
            [
                'id'    => 4,
                'name' => 'Ointment',
                'slug' => 'ointment',
                'user_id'=>1
            ],
            [
                'id'    => 5,
                'name' => 'Powder Suspension',
                'slug' => 'powder suspension',
                'user_id'=>1
            ],
            [
                'id'    => 6,
                'name' => 'Syrup',
                'slug' => 'syrup',
                'user_id'=>1
            ],
            [
                'id'    => 7,
                'name' => 'Tablet',
                'slug' => 'tablet',
                'user_id'=>1
            ],
            [
                'id'    => 8,
                'name' => 'Others',
                'slug' => 'others',
                'user_id'=>1
            ]
        ]);

        $producttypes->each(function ($producttype){
            ProductType::insert($producttype);
        });
    }
}
