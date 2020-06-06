<?php

namespace CI4Xpander;

use phpDocumentor\Reflection\DocBlockFactory;

trait DocBlockTrait
{
    /**
     * @var DocBlockFactory
     */
    protected DocBlockFactory $_docBlockFactory;

    protected function _initDocBlock()
    {
        $this->_docBlockFactory = DocBlockFactory::createInstance();
    }
}
