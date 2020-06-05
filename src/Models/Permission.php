<?php

namespace Xpander\Models;

class Permission extends \Xpander\Model
{
    protected $table = 'permission';
    protected $allowedFields = [
        'code', 'name', 'description', 'status_id'
    ];
    protected $returnType = \Xpander\Entities\Permission::class;
}
