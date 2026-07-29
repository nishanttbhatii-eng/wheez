<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CmsPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $modules = [
            'user',
            'role',
            'permission',
            'page',
            'service',
            'category',
            'city',
            'state',
        ];

        foreach ($modules as $module) {
            foreach (['list', 'create', 'edit', 'delete'] as $suffix) {
                Permission::firstOrCreate([
                    'name' => "{$module}-{$suffix}",
                    'guard_name' => 'web',
                ]);
            }
        }

        foreach (array_keys(config('cms_roles.role_permissions', [])) as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }
    }
}
