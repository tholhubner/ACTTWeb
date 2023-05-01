<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): Response
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);

        return Inertia::render('Roles/Index', [
            'roles' => $roles
        ])->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $permissions = Permission::get();

        return Inertia::render('Roles/Create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect(route('roles.index'))
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return \Inertia\Response
     */
    public function show(Role $role)
    {
        $role = $role;
        $role_permissions = $role->permissions;

        return Inertia::render('Roles/Show', [
            'role' => $role,
            'role_permissions' => $role_permissions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Inertia\Response
     */
    public function edit(Role $role)
    {
        $role_permissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'role_permissions' => $role_permissions,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Role $role
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Role $role, Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));
        $role->syncPermissions($request->get('permission'));

        return redirect(route('roles.index'))
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect(route('roles.index'))
            ->with('success', 'Role deleted successfully.');
    }
}
