<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return Inertia::render('admin/role/rolepermission', compact('roles', 'permissions'));
    }

    // Store role with permissions
    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $role = Role::create(['name' => $request->name]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->back();
    }

    // Store permission
    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Permission::firstOrCreate(['name' => $request->name]);
        return redirect()->back();
    }

    // Update role
    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->back();
    }

    // Delete role & remove all assigned permissions
    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions([]); // remove all assigned permissions
        $role->delete();

        return redirect()->back();
    }

    // Delete permission & remove from all roles
    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);

        // Remove this permission from all roles
        $roles = Role::all();
        foreach ($roles as $role) {
            if ($role->hasPermissionTo($permission->name)) {
                $role->revokePermissionTo($permission->name);
            }
        }

        $permission->delete();

        return redirect()->back();
    }
}
