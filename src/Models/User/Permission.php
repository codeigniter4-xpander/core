<?php

namespace Xpander\Models\User;

class Permission extends \Xpander\Model
{
    protected $table = 'user_permission';
    protected $allowedFields = [
        'status_id', 'user_id', 'permission_id', 'C', 'R', 'U', 'D'
    ];
    protected $returnType = \Xpander\Entities\User\Permission::class;
}
