<?php

namespace Xpander\Models\Role;

class Permission extends \Xpander\Model
{
    protected $table = 'permission';
    protected $allowedFields = [
        'role_id', 'permission_id', 'status_id', 'C', 'R', 'U', 'D'
    ];
    protected $returnType = \Xpander\Entities\Role\Permission::class;
}
