<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin51@test.local'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
            ]
        );
    }
}
