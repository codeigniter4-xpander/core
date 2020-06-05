<?php

namespace Xpander\Models\Process;

class Type extends \Xpander\Model
{
    protected $table = 'process_type';
    protected $allowedFields = [
        'status_id', 'code', 'name', 'description'
    ];
    protected $returnType = \Xpander\Entities\Process\Type::class;
}
