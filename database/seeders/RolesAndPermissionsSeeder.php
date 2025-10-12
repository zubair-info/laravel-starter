<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $viewer = Role::firstOrCreate(['name' => 'viewer']);

        $viewDashboard = Permission::firstOrCreate(['name' => 'view.dashboard']);
        $manageUsers = Permission::firstOrCreate(['name' => 'manage.users']);
        $editProfile = Permission::firstOrCreate(['name' => 'edit.profile']);
        $roles = Permission::firstOrCreate(['name' => 'roles']);

        $admin->syncPermissions([$viewDashboard, $manageUsers, $editProfile,$roles]);
        $editor->syncPermissions([$viewDashboard, $editProfile,$roles]);
        $viewer->syncPermissions([$viewDashboard]);

        User::all()->each(function($user) use ($admin) {
            $user->assignRole($admin);
        });
    }
}
