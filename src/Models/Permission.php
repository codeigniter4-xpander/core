<?php

namespace CI4Xpander\Models;

class Permission extends \CI4Xpander\Model
{
    protected $table = 'permission';
    protected $allowedFields = [
        'code', 'name', 'description', 'status_id'
    ];
    protected $returnType = \CI4Xpander\Entities\Permission::class;
}
