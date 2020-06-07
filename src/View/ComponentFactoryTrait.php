<?php

namespace CI4Xpander\View;

trait ComponentFactoryTrait
{
    /**
     * @param Data $data
     * @return self
     */
    public static function create($data = null)
    {
        return new self($data);
    }
}
