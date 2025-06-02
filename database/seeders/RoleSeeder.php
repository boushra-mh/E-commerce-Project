<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $superAdminRoles= Role::create([
            'name' => 'super-admin',
            'guard_name' => 'admin',
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name' => 'admin',
        ]);
        Role::create([
            'name' => 'user',
            'guard_name' => 'user',
        ]);
        $Permissions=Permission::get();
        foreach( $Permissions as $permission)
        {

             $superAdminRoles->givePermissionTo($permission);
        }
    }
}
