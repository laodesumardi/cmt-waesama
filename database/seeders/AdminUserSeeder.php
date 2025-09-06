<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@camat.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        
        // Assign admin role
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
        
        // Create super admin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@camat.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        
        // Assign super admin role
        if (!$superAdmin->hasRole('super-admin')) {
            $superAdmin->assignRole('super-admin');
        }
        
        $this->command->info('Admin users created successfully!');
        $this->command->info('Admin: admin@camat.com / password123');
        $this->command->info('Super Admin: superadmin@camat.com / password123');
    }
}
