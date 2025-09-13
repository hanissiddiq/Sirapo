<?php

namespace Database\Seeders;
use Illuminate\Support\Str;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         User::factory()->create([
            'name' => 'Administrator Sirapo',
            'email' => 'admin@sirapo.com',
            'email_verified_at' => now(),
            'password' => bcrypt('mantap'), // passwordnya : mantap
            'remember_token' => Str::random(10),
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
