<?php

namespace Xpander\Entities;

class Status extends \Xpander\Entity
{
    protected $casts = [
        'code' => 'string',
        'name' => 'string',
        'description' => 'string'
    ];
}
