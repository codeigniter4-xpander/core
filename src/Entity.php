<?php

namespace CI4Xpander;

class Entity extends \CodeIgniter\Entity
{
    /**
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function __construct(?array $data = null)
    {
        $this->casts['id'] = 'integer';
        $this->casts['created_by'] = 'integer';
        $this->casts['updated_by'] = 'integer';
        $this->casts['deleted_by'] = 'integer';
        $this->casts['created_at'] = 'string';
        $this->casts['updated_at'] = 'string';
        $this->casts['deleted_at'] = 'string';

        parent::__construct($data);
    }
}
