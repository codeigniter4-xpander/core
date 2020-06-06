<?php

namespace CI4Xpander\Entities;

class Status extends \CI4Xpander\Entity
{
    protected $casts = [
        'code' => 'string',
        'name' => 'string',
        'description' => 'string'
    ];
}
