<?php

/**
 * CMS role names (Spatie roles) map to default permission names assigned on the user.
 * Permissions are set on the user at create/edit — not on the role record.
 */
$crud = fn (string $module): array => [
    "{$module}-list",
    "{$module}-create",
    "{$module}-edit",
    "{$module}-delete",
];

$allModules = ['user', 'role', 'permission', 'page', 'service', 'category', 'city', 'state'];

$fullAccess = [];
foreach ($allModules as $module) {
    $fullAccess = array_merge($fullAccess, $crud($module));
}

return [
    'role_permissions' => [
        'Super Admin' => $fullAccess,
        'CMS Manager' => array_merge(
            $crud('page'),
            $crud('service'),
            $crud('category'),
            $crud('city'),
            $crud('state'),
        ),
        'Content Editor' => $crud('page'),
        'Service Editor' => $crud('service'),
        'Master Data' => array_merge($crud('category'), $crud('city'), $crud('state')),
        'User Manager' => array_merge($crud('user'), $crud('role'), $crud('permission')),
    ],
];
