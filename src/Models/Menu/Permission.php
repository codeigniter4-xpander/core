<?php

namespace Xpander\Models\Menu;

class Permission extends \Xpander\Model
{
    protected $table = 'menu_permission';
    protected $allowedFields = [
        'status_id', 'menu_id', 'permission_id', 'C', 'R', 'U', 'D'
    ];
    protected $returnType = \Xpander\Entities\Menu\Permission::class;
}
