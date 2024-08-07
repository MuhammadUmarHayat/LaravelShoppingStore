<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Hashed password
            'role' => 0, // Assuming role 0 for admin
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add more dummy users if needed
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Hashed password
                'role' => 1, // Assuming role 1 for regular users
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}
