<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Database\Seeders\SettingSeeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            UnitSeeder::class,
            ProductTypeSeeder::class,
            PermissionSeeder::class
        ]);

        Customer::factory(15)->create();
        Supplier::factory()->create([
            'user_id' => '3'
        ]);

        Supplier::factory()->create([
            'user_id' => '4'
        ]);


        Supplier::factory()->create([
            'user_id' => '5'
        ]);


        $this->call(ProductsTableSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(SettingSeeder::class);



    }
}
