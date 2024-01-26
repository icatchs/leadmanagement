<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Admin User', 
            'email' => 'admin@ecs.com',
            'password' => Hash::make('admin123')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Sub Admin', 
            'email' => 'subadmin@ecs.com',
            'password' => Hash::make('admin123')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'Company One', 
            'email' => 'company@ecs.com',
            'password' => Hash::make('admin123')
        ]);
        $productManager->assignRole('Company');
    }
}