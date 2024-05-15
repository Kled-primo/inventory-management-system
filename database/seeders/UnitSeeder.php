<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = collect([
            [
                'name' => 'Milliliter',
                'slug' => 'milliliter',
                'short_code' => 'ml',
                'user_id'=>1
            ],
            [
                'name' => 'Milligram',
                'slug' => 'milligram',
                'short_code' => 'mg',
                'user_id'=>1
            ],
            [
                'name' => 'Gram',
                'slug' => 'gram',
                'short_code' => 'g',
                'user_id'=>1
            ],
            [
                'name' => 'Microgram',
                'slug' => 'microgram',
                'short_code' => 'mcg',
                'user_id'=>1
            ],
            [
                'name' => 'Milliequivalent',
                'slug' => 'milliequivalent',
                'short_code' => 'mEq',
                'user_id'=>1
            ]
        ]);

        $units->each(function ($unit){
            Unit::insert($unit);
        });
    }
}
