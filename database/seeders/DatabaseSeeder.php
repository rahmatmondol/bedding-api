<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Categories;
use App\Models\SubCategories;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345'),
        ]);

        $customer = \App\Models\User::factory()->create([
            'name' => 'customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('12345'),
        ]);

        $provider = \App\Models\User::factory()->create([
            'name' => 'provider',
            'email' => 'provider@provider.com',
            'password' => bcrypt('12345678'),
        ]);
        
        $adminRole = Role::create(['name' => 'admin']);
        $providerRole = Role::create(['name' => 'provider']);
        $customerRole = Role::create(['name' => 'customer']);

        $permissions = Permission::all();
        $adminRole->givePermissionTo($permissions);
        
        $admin->assignRole($adminRole);
        $customer->assignRole($customerRole);
        $provider->assignRole($providerRole);

        $providerRole->givePermissionTo([
            Permission::create(['name' => 'create services']),
            Permission::create(['name' => 'update services']),
            Permission::create(['name' => 'delete services']),
        ]);

        $customerRole->givePermissionTo([
            Permission::create(['name' => 'create biddings']),
        ]);

        $provider = \App\Models\User::factory(10)->create();
        $customer = \App\Models\User::factory(10)->create();

        foreach ($provider as $key => $value) {
            $value->assignRole('provider');
        }
        foreach ($customer as $key => $value) {
            $value->assignRole('customer');
        }

        $categories = Categories::factory()->count(10)->create();
      
    }
}
