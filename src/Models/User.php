<?php

namespace CI4Xpander\Models;

class User extends \CI4Xpander\Model
{
    protected $table = 'user';
    protected $allowedFields = [
        'code', 'name', 'email', 'password', 'status_id'
    ];
    protected $returnType = \CI4Xpander\Entities\User::class;
}
