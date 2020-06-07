<?php

namespace CI4Xpander;

trait ViewFactoryTrait
{
    /**
     * @param array $config
     * @return self
     */
    public static function create(array $config = []): self
    {
        return new self($config);
    }
}
