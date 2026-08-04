<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Define every permission your admin panel actually needs
        $permissions = [
            'manage services',
            'manage products',
            'manage product categories',
            'manage portfolio',
            'manage testimonials',
            'manage inquiries',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create (or fetch) the admin role and give it every permission
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // Create the master admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@com'],
            [
                'name' => 'Master Admin',
                'password' => Hash::make('11111111'), // change this before going live
            ]
        );

        $user->assignRole($adminRole);
    }
}
