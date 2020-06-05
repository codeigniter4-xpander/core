<?php

namespace Xpander\View;

class Data
{
    use \Xpander\ClassInitializerTrait, \Xpander\PropertyInitializerTrait, \Xpander\View\DataFactoryTrait;

    public function __construct(array $data = [])
    {
        $this->_initReflectionClass();
        $this->_initDocBlock();

        foreach ($data as $name => $value) {
            $this->{$name} = $value;
        }

        $this->_initProperty();
        $this->_init();
    }
}
