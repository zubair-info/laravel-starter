<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserRolePermissionController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'permissions'])->get();
        $roles = Role::all();
        $permissions = Permission::all();

        return Inertia::render('admin/role/userrolepermission', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    // Assign roles to user
    public function assignRole(Request $request, User $user)
    {
        $user->syncRoles($request->roles ?? []);
        return redirect()->back()->with('success', 'Roles updated');
    }

    // Assign permissions to user
    public function assignPermission(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions ?? []);
        return redirect()->back()->with('success', 'Permissions updated');
    }

    // Remove a specific role from user
    public function removeRole(User $user, Role $role)
    {
        $user->removeRole($role);
        return redirect()->back()->with('success', 'Role removed from user');
    }

    // Remove a specific permission from user
    public function removePermission(User $user, Permission $permission)
    {
        $user->revokePermissionTo($permission);
        return redirect()->back()->with('success', 'Permission removed from user');
    }
    public function removeAllAssignments(User $user)
    {
        // Remove all roles
        $user->syncRoles([]);

        // Remove all permissions
        $user->syncPermissions([]);

        return redirect()->back();
    }
}
