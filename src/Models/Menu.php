<?php

namespace Xpander\Models;

class Menu extends \Xpander\Model
{
    protected $table = 'menu';
    protected $allowedFields = [
        'code', 'name', 'description', 'url', 'icon', 'level', 'parent_id', 'status_id', 'sequence_position', 'type_id'
    ];
    protected $returnType = \Xpander\Entities\Menu::class;
}
