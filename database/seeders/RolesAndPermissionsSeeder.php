<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Define roles and their permissions
        $rolesPermissions = [
            'admin' => [
                'hero.view',
                'hero.create',
                'hero.edit',
                'hero.delete',
                'user.view',
                'user.create',
                'user.edit',
                'user.delete',
            ],
            'editor' => [
                'hero.view',
                'hero.create',
                'hero.edit',
            ],
            'user' => [
                'hero.view',
            ],
        ];

        // Collect all unique permissions
        $allPermissions = [];
        foreach ($rolesPermissions as $permissions) {
            $allPermissions = array_merge($allPermissions, $permissions);
        }
        $allPermissions = array_unique($allPermissions);

        // Create permissions
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        foreach ($rolesPermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($permissions);
        }

        // Assign roles to specific users
        $userRoles = [
            'admin@example.com' => 'admin',
            'editor@example.com' => 'editor',
            'user@example.com' => 'user',
        ];

        foreach ($userRoles as $email => $roleName) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->assignRole($roleName);
            }
        }

        $this->command->info('Roles, permissions, and user assignments seeded successfully!');
    }
}
