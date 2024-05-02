<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'edit post',
            'delete post',
            'add post',
            'add comment',
            'edit comment',
            'delete comment',
            'edit users',
            'delete users',
            'delete own post',
            'delete own comment',
            'edit own post',
            'edit own comment',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'edit post',
            'edit comment',

        ]);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'add comment',
            'add post',
            'delete own post',
            'delete own comment',
            'edit own post',
            'edit own comment'
        ]);
    }
}
