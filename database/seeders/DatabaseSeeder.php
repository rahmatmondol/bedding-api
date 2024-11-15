<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Images;
use App\Models\Services;
use App\Models\Fees;
use App\Models\Profile;
use App\Models\Locations;
use App\Models\Skills;

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
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        $customer = \App\Models\User::factory()->create([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'password' => bcrypt('12345678'),
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

        // Create 1 fees
        Fees::factory()->count(1)->create();

        // Create 20 locations
        Locations::factory()->count(50)->create();

        // Create 3 profiles
        // Profile::factory()->count(3)->create();
        
    
        // Create 10 skills
        $skills = array(
            ['name' => 'Cooking', 'description' => 'Cooking services'],
            ['name' => 'Cleaning', 'description' => 'Cleaning services'],
            ['name' => 'Cooking', 'description' => 'Cooking services'],
            ['name' => 'Cleaning', 'description' => 'Cleaning services'],
            ['name' => 'Cooking', 'description' => 'Cooking services'],
            ['name' => 'Cleaning', 'description' => 'Cleaning services'],
            ['name' => 'Cooking', 'description' => 'Cooking services'],
            ['name' => 'Cleaning', 'description' => 'Cleaning services'],
            ['name' => 'Cooking', 'description' => 'Cooking services'],
            ['name' => 'Cleaning', 'description' => 'Cleaning services'],
        );
        foreach ($skills as $skill) {
            Skills::factory()->create([
                    'name' => $skill['name'],
                    'description' => $skill['description'],
                ]);
        }

        // Create 50 categories and 50 subcategories
        Categories::factory()
            ->count(10)
            ->create()
            ->each(
                fn($category) => SubCategories::factory(10)->create(['category_id' => $category->id])
            );


        // Create 10 services, each with 3 related images
        Services::factory()
        ->count(50)
        ->create()
        ->each(function ($service) {
            // Attach 3 random skills
            $service->skills()->sync(Skills::all()->random(3)->pluck('id')->toArray());
    
            // Create and assign images directly if it is a hasMany relationship
            Images::factory()->count(2)->create(['service_id' => $service->id]);
        });
    

      
    }
}

