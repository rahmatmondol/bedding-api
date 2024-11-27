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
use App\Models\TermsAndConditions;
use App\Models\PrivacyPolicy;

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

        $profile = Profile::factory()->make();
        $provider->profile()->save($profile);

        $profile = Profile::factory()->make();
        $customer->profile()->save($profile);
        
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

        // Create 50 categories and 50 subcategories
        Categories::factory()
            ->count(10)
            ->create()
            ->each(
                fn($category) => SubCategories::factory(10)->create(['category_id' => $category->id])
            );


        // Create 10 services, each with 3 related images
        Services::factory()
        ->count(10)
        ->create()
        ->each(function ($service) {
            Images::factory()->count(2)->create(['service_id' => $service->id]);
        });
    
        // Create terms and conditions
        TermsAndConditions::create([
            'content' => '<h2>01 YOUR AGREMENTT</h2><p>This summary provides key points from our privacy notice, but you can find out more details about any of these topics by clicking the link following each key point or by using our table of contents below to find the section you are looking for. You can also click here to go directly to our table of contents.</p>'
        ]);

        // Create pryvacy policy
        PrivacyPolicy::create([
            'content' => '<h2>01 YOUR AGREMENTT</h2><p>This summary provides key points from our privacy notice, but you can find out more details about any of these topics by clicking the link following each key point or by using our table of contents below to find the section you are looking for. You can also click here to go directly to our table of contents.</p>'
        ]);
      
    }
}

