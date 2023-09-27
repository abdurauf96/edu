<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $permissions = Permission::where('name', 'LIKE', "%$keyword%")->with('roles')
                ->latest()->paginate($perPage);
        } else {
            $permissions = Permission::with('roles')->latest()->paginate($perPage);
        }

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create($validated);

        return redirect()->route('admin.permissions.index')->with('flash_message', 'Permission added!');
    }

    public function show(Permission $permission): View
    {
        return view('admin.permissions.show', compact('permission'));
    }

    public function edit(Permission $permission): View
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();

        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);
        $permission->update($validated);

        return redirect()->route('admin.permissions.index')->with('flash_message', 'Permission updated!');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return back()->with('flash_message', 'Permission deleted!');
    }

    public function assignRole(Request $request, Permission $permission): RedirectResponse
    {
        if ($permission->hasRole($request->get('role'))) {
            return back()->with('message', '"'. $request->get('role') .'" role exists on this: "'. $permission->name .'" permission');
        }
        $permission->assignRole($request->get('role'));

        return back()->with('message', '"'. $request->get('role') .'" role assigned to this: "'. $permission->name .'" permission');
    }

    public function removeRole(Permission $permission, Role $role): RedirectResponse
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->with('message', '"'. $role->name .'" role removed from this: "'. $permission->name .'" permission');
        }

        return back()->with('message', '"'. $role->name .'" role not exists on this: "'. $permission->name .'" permission');
    }
}
