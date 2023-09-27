<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $roles = Role::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $roles = Role::latest()->paginate($perPage);
        }

        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
//        $permissions = Permission::select('id', 'name', 'label')->get()->pluck('label', 'name');

//        return view('admin.roles.create', compact('permissions'));
        return view('admin.roles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create($validated);
//        $role->permissions()->detach();

//        if ($request->has('permissions')) {
//            foreach ($request->permissions as $permission_name) {
//                $permission = Permission::whereName($permission_name)->first();
//                $role->givePermissionTo($permission);
//            }
//        }

        return redirect()->route('admin.roles.index')->with('flash_message', 'Role added!');
    }

    public function show(Role $role): View
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);
        $role->update($validated);
//        $role->permissions()->detach();
//
//        if ($request->has('permissions')) {
//            foreach ($request->permissions as $permission_name) {
//                $permission = Permission::whereName($permission_name)->first();
//                $role->givePermissionTo($permission);
//            }
//        }

        return redirect()->route('admin.roles.index')->with('flash_message', 'Role updated!');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return back()->with('flash_message', 'Role deleted!');
    }

    public function givePermission(Request $request, Role $role): RedirectResponse
    {
        if ($role->hasPermissionTo($request->get('permission'))) {
            return back()->with('flash_message', 'Permission exists');
        }
        $role->givePermissionTo($request->get('permission'));
        return back()->with('flash_message', 'Permission added to this: "'. $role->name .'" role');
    }

    public function revokePermission(Role $role, Permission $permission): RedirectResponse
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('flash_message', 'Permission revoked');
        }
        return back()->with('flash_message', 'Permission not exists on this role');
    }
}
