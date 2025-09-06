<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // News management
            'view news',
            'create news',
            'edit news',
            'delete news',
            'publish news',
            
            // Announcement management
            'view announcements',
            'create announcements',
            'edit announcements',
            'delete announcements',
            'publish announcements',
            
            // Gallery management
            'view galleries',
            'create galleries',
            'edit galleries',
            'delete galleries',
            
            // Letter request management
            'view letter-requests',
            'create letter-requests',
            'edit letter-requests',
            'delete letter-requests',
            'process letter-requests',
            'approve letter-requests',
            'reject letter-requests',
            
            // Complaint management
            'view complaints',
            'create complaints',
            'edit complaints',
            'delete complaints',
            'assign complaints',
            'respond complaints',
            'resolve complaints',
            
            // Village management
            'view villages',
            'create villages',
            'edit villages',
            'delete villages',
            
            // Transparency management
            'view transparency',
            'create transparency',
            'edit transparency',
            'delete transparency',
            'publish transparency',
            
            // Notification management
            'view notifications',
            'create notifications',
            'edit notifications',
            'delete notifications',
            
            // Dashboard access
            'view dashboard',
            'view admin-dashboard',
            'view staff-dashboard',
            
            // Reports
            'view reports',
            'export reports',
            
            // Settings
            'manage settings',
            'manage roles',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin Role
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());
        
        // Admin Role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminPermissions = [
            'view users', 'create users', 'edit users',
            'view news', 'create news', 'edit news', 'delete news', 'publish news',
            'view announcements', 'create announcements', 'edit announcements', 'delete announcements', 'publish announcements',
            'view galleries', 'create galleries', 'edit galleries', 'delete galleries',
            'view letter-requests', 'edit letter-requests', 'process letter-requests', 'approve letter-requests', 'reject letter-requests',
            'view complaints', 'edit complaints', 'assign complaints', 'respond complaints', 'resolve complaints',
            'view villages', 'create villages', 'edit villages', 'delete villages',
            'view transparency', 'create transparency', 'edit transparency', 'delete transparency', 'publish transparency',
            'view notifications', 'create notifications', 'edit notifications', 'delete notifications',
            'view dashboard', 'view admin-dashboard',
            'view reports', 'export reports',
            'manage settings',
        ];
        $adminRole->givePermissionTo($adminPermissions);
        
        // Staff Role
        $staffRole = Role::firstOrCreate(['name' => 'staff']);
        $staffPermissions = [
            'view news', 'create news', 'edit news',
            'view announcements', 'create announcements', 'edit announcements',
            'view galleries', 'create galleries', 'edit galleries',
            'view letter-requests', 'edit letter-requests', 'process letter-requests',
            'view complaints', 'edit complaints', 'respond complaints',
            'view villages',
            'view transparency', 'create transparency', 'edit transparency',
            'view notifications',
            'view dashboard', 'view staff-dashboard',
            'view reports',
        ];
        $staffRole->givePermissionTo($staffPermissions);
        
        // User Role
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userPermissions = [
            'view news',
            'view announcements',
            'view galleries',
            'create letter-requests',
            'view letter-requests',
            'create complaints',
            'view complaints',
            'view villages',
            'view transparency',
            'view notifications',
            'view dashboard',
        ];
        $userRole->givePermissionTo($userPermissions);
        
        // Create default super admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@camat.go.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super-admin');
        
        // Create default admin user
        $admin = User::create([
            'name' => 'Admin Camat',
            'email' => 'admin.camat@camat.go.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $admin->assignRole('admin');
        
        // Create default staff user
        $staff = User::create([
            'name' => 'Staff Camat',
            'email' => 'staff@camat.go.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true,
        ]);
        $staff->assignRole('staff');
    }
}
