<?php

namespace Xpander\Models;

class Process extends \Xpander\Model
{
    protected $table = 'process';
    protected $allowedFields = [
        'code', 'name', 'description', 'status_id', 'property', 'type_id'
    ];
    protected $returnType = \Xpander\Entities\Process::class;
}
