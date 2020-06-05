<?php

namespace Xpander\View;

class Component
{
    /**
     * @var string
     */
    protected string $_name = '';

    /**
     * @var string
     */
    protected string $_view = 'Main';

    /**
     * @var \Xpander\View\Data
     */
    public ?\Xpander\View\Data $data = null;

    use \Xpander\ClassInitializerTrait, \Xpander\PropertyInitializerTrait, \Xpander\View\ComponentFactoryTrait;

    public function __construct(Data $data = null)
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

    public function render()
    {
        $autoloader = \Config\Services::autoloader();
        $viewFile = realpath($autoloader->getNamespace(explode('\View\Component', $this->_reflectionClass->getNamespaceName())[0])[0]) . '/Views/Component/' . $this->_reflectionClass->getShortName() . '/' . $this->_view . '.php';

        $baseDir = str_replace('\View\Component\\', '\Views\Component\\', $this->_reflectionClass->getName());
        if (!file_exists($viewFile)) {
            $parents = class_parents($this);
            foreach ($parents as $parent) {
                $reflection = new \ReflectionClass($parent);
                $viewFile = realpath($autoloader->getNamespace(explode('\View\Component', $reflection->getNamespaceName())[0])[0]) . '/Views/Component/' . $reflection->getShortName() . '/' . $this->_view . '.php';
                if (file_exists($viewFile)) {
                    $baseDir = str_replace('\View\Component\\', '\Views\Component\\', $reflection->getName());
                    break;
                }
            }
        }

        return view($baseDir . '\\' . $this->_view, [
            'data' => $this->data
        ]);
    }
}
