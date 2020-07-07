<?php

namespace CI4Xpander\View;

class Component
{
    /**
     * @var string
     */
    protected $_name = '';

    /**
     * @var string
     */
    protected $_view = 'Main';

    /**
     * @var \CI4Xpander\View\Data
     */
    public $data = null;

    use \CI4Xpander\ClassInitializerTrait, \CI4Xpander\PropertyInitializerTrait, \CI4Xpander\View\ComponentFactoryTrait;

    /**
     * @param \CI4Xpander\View\Data|null $data
     */
    public function __construct($data = null)
    {
        $this->_initReflectionClass();
        $this->_initDocBlock();

        if (empty($this->_name)) {
            $this->_name = $this->_reflectionClass->getShortName();
        }

        $this->data = $data;

        $this->_initProperty();

        if (empty($this->_view)) {
            $this->_view = lcfirst($this->_name);
        }

        $this->_init();
    }

    public function fillData($data = [])
    {
        foreach ($data as $name => $value) {
            $this->data->{$name} = $value;
        }

        return $this;
    }

    public function render()
    {
        $autoloader = \Config\Services::autoloader();
        $exName = explode('\View\Component\\', $this->_reflectionClass->getName());
        $viewFile = realpath($autoloader->getNamespace($exName[0])[0]) . '/Views/Component/' . str_replace('\\', '/', $exName[1]) . '/' . $this->_view . '.php';

        $baseDir = str_replace('\View\Component\\', '\Views\Component\\', $this->_reflectionClass->getName());

        if (!file_exists($viewFile)) {
            $parents = class_parents($this);
            foreach ($parents as $parent) {
                $reflection = new \ReflectionClass($parent);
                $exName = explode('\View\Component\\', $reflection->getName());
                $viewFile = realpath($autoloader->getNamespace($exName[0])[0]) . '/Views/Component/' . str_replace('\\', '/', $exName[1]) . '/' . $this->_view . '.php';
                if (file_exists($viewFile)) {
                    $baseDir = str_replace('\View\Component\\', '\Views\Component\\', $reflection->getName());
                    break;
                }
            }
        }

        return view($baseDir . '\\' . $this->_view, [
            'data' => $this->data
        ], [
            'saveData' => false
        ]);
    }

    public function __toString()
    {
        return $this->render();
    }
}
