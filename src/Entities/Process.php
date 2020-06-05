<?php

namespace Xpander\Entities;

class Process extends \Xpander\Entity
{
    protected $casts = [
        'status_id' => 'integer',
        'type_id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'property' => 'json'
    ];
}
