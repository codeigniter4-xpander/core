<?php

namespace CI4Xpander\Entities\User;

class Role extends \CI4Xpander\Entity
{
    protected $casts = [
        'status_id' => 'integer',
        'user_id' => 'integer',
        'role_id' => 'integer'
    ];
}
