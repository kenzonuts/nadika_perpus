<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'books.view', 'books.create', 'books.update', 'books.delete',
            'categories.view', 'categories.create', 'categories.update', 'categories.delete',
            'members.view', 'members.create', 'members.update', 'members.delete',
            'borrowings.view', 'borrowings.create', 'borrowings.update', 'borrowings.delete',
            'returns.view', 'returns.create',
            'fines.view', 'fines.manage',
            'reports.view', 'reports.export',
            'audit.view',
            'settings.view', 'settings.update',
            'users.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $superAdmin = Role::findOrCreate('super-admin', 'web');
        $librarian = Role::findOrCreate('librarian', 'web');
        $member = Role::findOrCreate('member', 'web');

        $superAdmin->syncPermissions($permissions);

        $librarian->syncPermissions(array_filter(
            $permissions,
            fn (string $permission): bool => $permission !== 'users.manage'
        ));

        $member->syncPermissions([
            'books.view',
            'borrowings.view',
            'returns.view',
        ]);
    }
}
