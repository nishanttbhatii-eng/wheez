<?php

return [
    'roles' => [
        'team_lead' => [
            'label' => 'Team Lead',
            'permissions' => [
                'manage_staff',
                'view_reports',
            ],
        ],
        'hr' => [
            'label' => 'HR',
            'permissions' => [
                'manage_staff',
                'view_reports',
            ],
        ],
        'emp' => [
            'label' => 'Employee',
            'permissions' => [],
        ],
    ],

    'permissions' => [
        'manage_staff' => 'Manage Users',
        'view_reports' => 'View Reports',
    ],

    /*
    | CMS admin permissions (Spatie) applied per HR role on staff create/edit.
    | Keys must match permission names in the database.
    */
    'cms_permissions_by_role' => [
        'team_lead' => [
            'page-list', 'page-create', 'page-edit', 'page-delete',
            'service-list', 'service-create', 'service-edit', 'service-delete',
            'category-list', 'category-create', 'category-edit', 'category-delete',
            'city-list', 'city-create', 'city-edit', 'city-delete',
            'state-list', 'state-create', 'state-edit', 'state-delete',
            'user-list', 'user-create', 'user-edit', 'user-delete',
        ],
        'hr' => [
            'user-list', 'user-create', 'user-edit',
            'role-list', 'permission-list',
        ],
        'emp' => [],
    ],
];
