<?php

namespace Xpander\Entities\User;

class Role extends \Xpander\Entity
{
    protected $casts = [
        'status_id' => 'integer',
        'user_id' => 'integer',
        'role_id' => 'integer'
    ];
}
