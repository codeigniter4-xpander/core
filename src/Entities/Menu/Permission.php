<?php

namespace Xpander\Entities\Menu;

class Permission extends \Xpander\Entity
{
    protected $casts = [
        'status_id' => 'integer',
        'menu_id' => 'integer',
        'permission_id' => 'integer',
        'C' => 'boolean',
        'R' => 'boolean',
        'U' => 'boolean',
        'D' => 'boolean',
    ];

    protected $datamap = [
        'C' => 'isCreate',
        'R' => 'isRead',
        'U' => 'isUpdate',
        'D' => 'isDelete'
    ];
}
