<?php

namespace Database\Seeders;
use Illuminate\Support\Str;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $user = User::factory()->create([
        //     'name' => 'Administrator Sirapo',
        //     'email' => 'admin@sirapo.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('mantap'), // passwordnya : mantap
        //     'remember_token' => Str::random(10),
        // ]);

        // $user->assignRole('owner');

        // Role::firstOrCreate(['name' => 'owner', 'guard_name' => 'web']);
        // Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);
        // Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);


        // Membuat user dengan role 'owner'
        $userOwner = User::factory()->create([
            'name' => 'Administrator Sirapo',
            'email' => 'admin@sirapo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('mantap'), // passwordnya : mantap
            'remember_token' => Str::random(10),
        ]);

        // $userOwner->assignRole('owner');




        $this->call([
            RolePermissionSeeder::class,
            // Add other seeders here as needed
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
