<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create(['name' => 'owner', 'guard_name' => 'web']);
        $customerRole = Role::create(['name' => 'customer', 'guard_name' => 'web']);

        $user = User::create([
            'name' => 'hanis',
            'email' => 'hanissiddiq10@gmail.com',
            'password' => bcrypt('mantap'),
        ]);

        $user->assignRole($ownerRole);

    }
}
