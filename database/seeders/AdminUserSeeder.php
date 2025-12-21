<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Check if admin user already exists
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
            $this->command->info('Admin user created successfully!');
        } else {
            // Update existing admin user
            User::where('email', 'admin@example.com')->update([
                'is_admin' => true,
                'password' => Hash::make('password')
            ]);
            $this->command->info('Admin user updated successfully!');
        }
        
        $this->command->warn('Login with: admin@example.com / password');
    }
}