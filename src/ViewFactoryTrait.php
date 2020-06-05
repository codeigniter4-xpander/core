<?php

namespace Xpander;

trait ViewFactoryTrait
{
    /**
     * @param array $config
     * @return self
     */
    public static function create(array $config = [])
    {
        return new self($config);
    }
}
