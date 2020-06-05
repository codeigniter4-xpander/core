<?php

namespace Xpander\Entities;

class User extends \Xpander\Entity
{
    protected $casts = [
        'status_id' => 'integer',
        'code' => 'string',
        'email' => 'string',
        'name' => 'string',
        'password' => 'string',
    ];

    const SCHEMA = [
        'user_role' => [
            \Xpander\Entities\User\Role::class,
            '$target' => 'user_id',
            'role' => [
                Role::class,
                '$source' => 'role_id',
                'role_permission' => [
                    \Xpander\Entities\Role\Permission::class,
                    '$target' => 'role_id',
                    'permission' => [
                        Permission::class,
                        '$source' => 'permission_id',
                        'status' => [
                            Status::class,
                            '$source' => 'status_id',
                        ],
                    ],
                    'status' => [
                        Status::class,
                        '$source' => 'status_id',
                    ],
                ],
                'status' => [
                    Status::class,
                    '$source' => 'status_id',
                ],
            ],
            'status' => [
                Status::class,
                '$source' => 'status_id',
            ],
        ],
        'user_permission' => [
            \Xpander\Entities\User\Permission::class,
            '$target' => 'user_id',
            'permission' => [
                Permission::class,
                '$source' => 'permission_id',
                'status' => [
                    Status::class,
                    '$source' => 'status_id'
                ]
            ],
            'status' => [
                Status::class,
                '$source' => 'status_id',
            ],
        ],
        'status' => [
            Status::class,
            '$source' => 'status_id',
        ],
    ];
}
