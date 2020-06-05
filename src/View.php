<?php namespace CI4Xpander;

use Exception;

class View
{
    protected $_name = 'CI4Xpander';
    protected $_view = 'Main';

    public $data = null;

    use ClassInitializerTrait;

    public function __construct($config = [])
    {
        if (empty($this->_name)) {
            throw new Exception('View name cannot empty or null');
        }

        $this->_init();
    }
}
