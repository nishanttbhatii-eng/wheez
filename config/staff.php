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
];
