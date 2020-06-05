<?php

namespace Xpander\Entities;

class Role extends \Xpander\Entity
{
    protected $casts = [
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'status_id' => 'integer',
        'level' => 'integer',
        'parent_id' => 'integer'
    ];
}
