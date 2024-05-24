<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view control page']);
        Permission::create(['name' => 'view purchase page']);

        $role1 = Role::create(['name' => 'Super-Admin']);
        $role2 = Role::create(['name' => 'Employee']);
        $role3 = Role::create(['name' => 'Supplier']);

        $user = User::find(1);
        $user->assignRole($role1);

        $user = User::find(2);
        $user->assignRole($role2);

        $user = User::find(3);
        $user->assignRole($role3);


    }
}
