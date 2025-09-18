<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Str;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create(['name' => 'owner', 'guard_name' => 'web']);
        $customerRole = Role::create(['name' => 'customer', 'guard_name' => 'web']);
        $satffRole = Role::create(['name' => 'staff', 'guard_name' => 'web']);


        // $user = User::create([
        //     'name' => 'hanis',
        //     'email' => 'hanissiddiq10@gmail.com',
        //     'password' => bcrypt('mantap'),
        // ]);

        // $user->assignRole($ownerRole);

        // Membuat user dengan role 'staff'
       $userOwner = User::factory()->create([
           'name' => 'Owner Sirapo',
           'email' => 'owner@sirapo.com',
           'email_verified_at' => now(),
           'password' => bcrypt('mantap'),
           'remember_token' => Str::random(10),
       ]);

       $userOwner->assignRole('owner');

         // Membuat user dengan role 'staff'
        $userStaff = User::factory()->create([
            'name' => 'Staff Sirapo',
            'email' => 'staff@sirapo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('mantap'),
            'remember_token' => Str::random(10),
        ]);

        $userStaff->assignRole('staff');

        // Membuat user dengan role 'customer'
        $userCustomer = User::factory()->create([
            'name' => 'Customer Sirapo',
            'email' => 'customer@sirapo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('mantap'),
            'remember_token' => Str::random(10),
        ]);

        $userCustomer->assignRole('customer');

    }
}
