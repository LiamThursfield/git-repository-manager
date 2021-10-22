<?php

return [
    'admin' => [
        'url' => env('GRM_ADMIN_URL', null),
    ],

    'file_manager' => [
        'uploads' => [
            'enabled' => env('GRM_FILE_MANAGER_UPLOADS_ENABLED', false),
        ]
    ],

    'pagination' => [
        'links_on_each_side' => env('GRM_PAGINATION_LINKS_ON_EACH_SIDE', 1),
    ],

    'web' => [
        // If web is disabled, users will always be redirected to admin when trying to access the home page
        'enabled' => env('GRM_WEB_ENABLED', false)
    ],
];
