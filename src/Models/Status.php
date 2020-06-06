<?php

namespace CI4Xpander\Models;

class Status extends \CI4Xpander\Model
{
    protected $table = 'status';
    protected $allowedFields = [
        'code', 'name', 'description'
    ];
    protected $returnType = \CI4Xpander\Entities\Status::class;
}
