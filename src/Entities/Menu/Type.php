<?php

namespace CI4Xpander\Entities\Menu;

class Type extends \CI4Xpander\Entity
{
    protected $casts = [
        'status_id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'description' => 'string'
    ];
}
