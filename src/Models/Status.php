<?php

namespace Xpander\Models;

class Status extends \Xpander\Model
{
    protected $table = 'status';
    protected $allowedFields = [
        'code', 'name', 'description'
    ];
    protected $returnType = \Xpander\Entities\Status::class;
}
