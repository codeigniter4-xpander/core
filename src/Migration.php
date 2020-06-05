<?php

namespace Xpander;

class Migration extends \CodeIgniter\Database\Migration
{
    use \Xpander\ClassInitializerTrait;

    public function __construct(\CodeIgniter\Database\Forge $forge = null)
    {
        parent::__construct($forge);

        $this->_init();
    }

    public function up()
    {}

    public function down()
    {}
}
