<?php

namespace Xpander\Models;

class Role extends \Xpander\Model
{
    protected $table = 'role';
    protected $allowedFields = [
        'code', 'name', 'description', 'status_id', 'level', 'parent_id'
    ];
    protected $returnType = \Xpander\Entities\Role::class;
}
