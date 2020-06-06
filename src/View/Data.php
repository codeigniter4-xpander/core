<?php

namespace CI4Xpander\View;

class Data
{
    use \CI4Xpander\ClassInitializerTrait, \CI4Xpander\PropertyInitializerTrait, \CI4Xpander\View\DataFactoryTrait;

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
