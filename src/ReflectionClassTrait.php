<?php

namespace CI4Xpander;

trait ReflectionClassTrait
{
    /**
     * @var \ReflectionClass
     */
    protected \ReflectionClass $_reflectionClass;

    protected function _initReflectionClass()
    {
        $this->_reflectionClass = new \ReflectionClass($this);
    }
}
