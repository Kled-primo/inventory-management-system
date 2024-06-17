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
            'user_id' => '3',
            'name' => 'Allps Pharmacy',
            'email' => 'allpspharma@gmail.com',
            'address' => '433 SANTOL STREET, SANTA MESA, BARANGGAY 505, ZONE 050 SAMPALOC, MANILA',
            'shopname' => 'Allps Pharmacy WHOLESALE DRUGS/MEDICINES'
        ]);

        Supplier::factory()->create([
            'user_id' => '4',
            'name' => 'Dyna Drug',
            'email' => 'info@dynadrug.com',
            'address' => 'Felipe Pike, Corner Lanite and Banner Streets, Pasig, 1600 Metro Manila',
            'shopname' => 'Dyna Drug Corporation'
        ]);

        $this->call(ProductsTableSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(SettingSeeder::class);



    }
}
