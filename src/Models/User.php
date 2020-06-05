<?php

namespace Xpander\Models;

class User extends \Xpander\Model
{
    protected $table = 'user';
    protected $allowedFields = [
        'code', 'name', 'email', 'password', 'status_id'
    ];
    protected $returnType = \Xpander\Entities\User::class;
}
