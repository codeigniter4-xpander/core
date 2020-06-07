<?php

namespace CI4Xpander;

trait ViewFactoryTrait
{
    /**
     * @param array $config
     * @return self
     */
    public static function create($config = [])
    {
        return new self($config);
    }
}
