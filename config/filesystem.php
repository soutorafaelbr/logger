<?php

return [
    'local' => [
        'driver'      => 'local',
        'root'        => storage_path('app'),
        'permissions' => [
            'file' => [
                'public'  => 0664,
                'private' => 0600,
            ],
            'dir' => [
                'public'  => 0775,
                'private' => 0700,
            ],
        ],
    ],
];
