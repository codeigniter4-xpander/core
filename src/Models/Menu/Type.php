<?php

namespace Xpander\Models\Menu;

use Xpander\Entities\Menu\Type as MenuType;
use Xpander\Model;

class Type extends Model
{
    protected $table = 'menu_type';
    protected $allowedFields = [
        'status_id', 'code', 'name', 'description'
    ];
    protected $returnType = MenuType::class;
}
