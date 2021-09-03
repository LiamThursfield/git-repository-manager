<?php

namespace App\Interfaces;

/**
 * Interface to define core system Permissions
 *
 * When adding a new Permission:
 *      - Add a new const for the permission
 *          - For the name: use the format {ACTION}_{SUBJECT} e.g. VIEW_USERS
 *          - For the value: Use the format {action} {subject} e.g. view users
 *
 *      - Add the permission to the ALL_PERMISSIONS const
 *          - Use the format {subject} => [{action} => {permission constant}] e.g. 'users' => ['view' => self::VIEW_USERS]
 *
 */
class PermissionInterface
{
    // Profile Permissions
    const EDIT_PROFILE = 'edit profile';
    const VIEW_PROFILE = 'view profile';

    // Pull Request Permissions
    const DELETE_PULL_REQUESTS  = 'delete pull_requests';
    const EDIT_PULL_REQUESTS    = 'edit pull_requests';
    const VIEW_PULL_REQUESTS    = 'view pull_requests';

    // Repository Permissions
    const CREATE_REPOSITORIES  = 'create repositories';
    const DELETE_REPOSITORIES  = 'delete repositories';
    const EDIT_REPOSITORIES    = 'edit repositories';
    const VIEW_REPOSITORIES    = 'view repositories';

    // Telescope Permissions
    const VIEW_TELESCOPE = 'view telescope';

    // User Permissions
    const CREATE_USERS  = 'create users';
    const DELETE_USERS  = 'delete users';
    const EDIT_USERS    = 'edit users';
    const VIEW_USERS    = 'view users';


    // All Permissions
    // This is used in User()->all_permissions
    const ALL_PERMISSIONS = [
        'profile' => [
            'edit' => self::EDIT_PROFILE,
            'view' => self::VIEW_PROFILE,
        ],
        'pull_requests' => [
            'delete'    => self::DELETE_PULL_REQUESTS,
            'edit'      => self::EDIT_PULL_REQUESTS,
            'view'      => self::VIEW_PULL_REQUESTS,
        ],
        'repositories' => [
            'create'    => self::CREATE_REPOSITORIES,
            'delete'    => self::DELETE_REPOSITORIES,
            'edit'      => self::EDIT_REPOSITORIES,
            'view'      => self::VIEW_REPOSITORIES,
        ],
        'telescope' => [
            'view'  => self::VIEW_TELESCOPE
        ],
        'users' => [
            'create'    => self::CREATE_USERS,
            'delete'    => self::DELETE_USERS,
            'edit'      => self::EDIT_USERS,
            'view'      => self::VIEW_USERS,
        ]
    ];

    static function getMiddlewareString($permissions)
    {
        if (is_array($permissions)) {
            $permissions = implode(',', $permissions);
        }

        return 'can:' . $permissions;
    }
}
