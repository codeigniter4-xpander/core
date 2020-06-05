<?php

namespace Xpander\Entities\Role;

class Permission extends \Xpander\Entity
{
    protected $casts = [
        'role_id' => 'integer',
        'permission_id' => 'integer',
        'status_id' => 'integer',
        'C' => 'boolean',
        'R' => 'boolean',
        'U' => 'boolean',
        'D' => 'boolean'
    ];

    protected $datamap = [
        'C' => 'isCreate',
        'R' => 'isRead',
        'U' => 'isUpdate',
        'D' => 'isDelete'
    ];
}
