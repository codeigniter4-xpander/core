<?php

namespace Xpander\Models\User;

class Role extends \Xpander\Model
{
    protected $table = 'user_role';
    protected $allowedFields = [
        'status_id', 'user_id', 'role_id'
    ];
    protected $returnType = \Xpander\Entities\User\Role::class;
}
