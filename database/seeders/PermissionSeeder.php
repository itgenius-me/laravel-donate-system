<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create(['name' => 'guest']);
        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo($permission);

        $permission = Permission::create(['name' => 'manager']);
        $role = Role::create(['name' => 'User']);
        $role->givePermissionTo($permission);
    }
}
