<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'assing roles']);
        Permission::create(['name' => 'add games']);
        Permission::create(['name' => 'add bundles']);
        Permission::create(['name' => 'add baners']);
        Permission::create(['name' => 'add valuations']);
        Permission::create(['name' => 'add payment methods']);

        Permission::create(['name' => 'add discount']);

        Permission::create(['name' => 'verify payment']);
        Permission::create(['name' => 'make recharge']);

        Permission::create(['name' => 'request recharge']);
        Permission::create(['name' => 'make payment']);



        // create roles and assign created permissions
        $client = Role::create(['name' => 'client'])
        ->givePermissionTo(['request recharge', 'make payment']);

        $operator = Role::create(['name' => 'operator'])
        ->givePermissionTo(['verify payment', 'make recharge']);

        $admin = Role::create(['name' => 'admin'])
        ->givePermissionTo(['verify payment', 'make recharge',
                            'add discount','add baners',
                            'add valuations','request recharge',
                            'make payment']);

        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());
    }
}
