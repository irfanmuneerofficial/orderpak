<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'admin' =>[
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
                'product-list',
                'product-create',
                'product-edit',
                'product-delete'
            ],
            'vendor' =>[
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
                'product-list',
                'product-create',
                'product-edit',
                'product-delete'
            ],
            'web' =>[
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
                'product-list',
                'product-create',
                'product-edit',
                'product-delete'
            ],
        ];


        foreach ($permissions as $guard_name => $permissionIterate) {
            foreach ($permissionIterate as $permission) {
                Permission::create(['name' => $permission, 'guard_name' => $guard_name]);
            }
        }
    }
}
