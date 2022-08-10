<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateCustomerSeeder extends Seeder
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

        $role = Role::create(['name' => 'Customer', 'guard_name' => 'web']);
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

        $user = User::create([
            'name' => 'Customer',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456')
        ]);

        // $role = Role::create(['name' => 'Customer']);

        // $permissions = Permission::pluck('id','id')->all();

        // $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
