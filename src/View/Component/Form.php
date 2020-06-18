<?php namespace CI4Xpander\View\Component;

class Form extends \CI4Xpander\View\Component
{
    protected $_name = 'Form';

    protected function _init()
    {
        parent::_init();

        helper('form');
    }

    use \CI4Xpander\View\ComponentFactoryTrait;
}
