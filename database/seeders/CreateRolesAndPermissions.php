<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'read users']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('create users');
        $role->givePermissionTo('read users');

        $role2 = Role::create(['name' => 'basic']);

        $role3 = Role::create(['name' => 'super-admin']);
        $role3->givePermissionTo('read users');
        $role3->givePermissionTo('create users');
        $role3->givePermissionTo('update users');
        $role3->givePermissionTo('delete users');

        $permissions = Permission::pluck('name', 'name')->all();

        $role->syncPermissions($permissions);
        $role3->syncPermissions($permissions);
    }
}
