<?php

namespace CI4Xpander;

trait ReflectionClassTrait
{
    /**
     * @var \ReflectionClass
     */
    protected $_reflectionClass;

    protected function _initReflectionClass()
    {
        $this->_reflectionClass = new \ReflectionClass($this);
    }
}
