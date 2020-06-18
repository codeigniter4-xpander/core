<?php namespace CI4Xpander\View\Component\Form;

class Data extends \CI4Xpander\View\Data
{
    public $method = 'post';
    public $action = '';
    public $hidden = [];
    public $input = [];

    use \CI4Xpander\View\DataFactoryTrait;
}
