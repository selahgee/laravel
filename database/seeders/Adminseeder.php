<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at'=>now(),
            'password' => Hash::make('Admin@123'), // Hashing the password
        ])->assignRole('admin'); // Assigning the 'admin' role to the user
    }
}
