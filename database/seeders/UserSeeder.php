<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::create([
            'username' => 'admin',
            'password_hash' => Hash::make('admin'), // Ganti dengan password yang aman
            'full_name' => 'Administrator',
            'role' => 'admin',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'username' => 'peminjam',
            'password_hash' => Hash::make('peminjam'), // Ganti dengan password yang aman
            'full_name' => 'Peminjam',
            'role' => 'member',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //2. Create 15 Member Users using Factory
        User::factory()->count(15)->create([
            'role' => 'member',
            'status' => 'active',
        ]);

        $this->command->info('User seeding completed: 1 admin and 15 members created.');
    }
}