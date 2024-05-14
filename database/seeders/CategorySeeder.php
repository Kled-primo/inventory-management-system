<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            [
                'id'    => 1,
                'name'  => 'Prescription',
                'slug'  => 'prescription',
                'user_id' => 1,
            ],
            [
                'id'    => 2,
                'name'  => 'Non-Prescription',
                'slug'  => 'nonprescription',
                'user_id' => 1,
            ],
            [
                'id'    => 3,
                'name'  => 'Non-Medication',
                'slug'  => 'nonmedication',
                'user_id' => 1,
            ]
        ]);

        $categories->each(function ($category) {
            Category::insert($category);
        });
    }
}
