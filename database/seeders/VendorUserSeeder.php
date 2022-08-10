<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VendorUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class VendorUserSeeder extends Seeder
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

        $role = Role::create(['name' => 'Vendor', 'guard_name' => 'vendor']);
        $role->givePermissionTo([
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ]);

        // $role->syncPermissions($permissions);
        $user = VendorUser::create([
            'first_name' => 'Vendor',
            'last_name' => 'User',
            'business_email' => 'vendor@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $user->assignRole([$role->id]);
    }
}
