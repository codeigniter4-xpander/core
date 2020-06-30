<?php namespace CI4Xpander\View\Component;

class Script extends \CI4Xpander\View\Component
{
    public $definitions = [];

    public function __construct($definitions = [])
    {
        $this->definitions = $definitions;
    }

    public function render()
    {
        $script = '';

        foreach ($this->definitions as $definition) {
            $script .= $definition;
        }

        return $script;
    }

    public function add($definition)
    {
        $this->definitions[] = $definition;
    }

    public function get()
    {
        return $this->definitions;
    }

    public static function create($definitions = [])
    {
        return new self($definitions);
    }
}