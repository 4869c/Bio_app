<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Default admin account for the project.
        Admin::updateOrCreate(
            ['email' => 'admin@bio.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
