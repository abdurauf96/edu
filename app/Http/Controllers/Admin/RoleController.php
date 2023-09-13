<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $roles = Role::where('name', 'LIKE', "%$keyword%")->orWhere('label', 'LIKE', "%$keyword%")
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
        $this->validate($request, ['name' => 'required']);

        $role = Role::create($request->all());
//        $role->permissions()->detach();

//        if ($request->has('permissions')) {
//            foreach ($request->permissions as $permission_name) {
//                $permission = Permission::whereName($permission_name)->first();
//                $role->givePermissionTo($permission);
//            }
//        }

        return redirect('admin/roles')->with('flash_message', 'Role added!');
    }

    public function show($id): View
    {
        $role = Role::findOrFail($id);

        return view('admin.roles.show', compact('role'));
    }

    public function edit($id): View
    {
        $role = Role::findOrFail($id);
//        $permissions = Permission::select('id', 'name', 'label')->get()->pluck('label', 'name');

        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, ['name' => 'required']);

        $role = Role::findOrFail($id);
        $role->update($request->all());
//        $role->permissions()->detach();
//
//        if ($request->has('permissions')) {
//            foreach ($request->permissions as $permission_name) {
//                $permission = Permission::whereName($permission_name)->first();
//                $role->givePermissionTo($permission);
//            }
//        }

        return redirect('admin/roles')->with('flash_message', 'Role updated!');
    }

    public function destroy($id): RedirectResponse
    {
        Role::destroy($id);

        return redirect('admin/roles')->with('flash_message', 'Role deleted!');
    }
}
