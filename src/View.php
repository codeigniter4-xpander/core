<?php

namespace Xpander;

class View
{
    /**
     * @var string
     */
    protected $_name = 'Xpander';

    /**
     * @var string
     */
    protected $_view = 'Main';

    /**
     * @var \Xpander\View\Data
     */
    public ?\Xpander\View\Data $data = null;

    use \Xpander\ClassInitializerTrait, \Xpander\PropertyInitializerTrait, \Xpander\ViewFactoryTrait;

    public function __construct(array $config = [])
    {
        if (empty($this->_name)) {
            throw new \Exception('View name cannot empty or null');
        }

        $this->_initReflectionClass();
        $this->_initDocBlock();

        foreach ($config as $name => $value) {
            $this->{$name} = $value;
        }

        $this->_initProperty();
        $this->_init();
    }

    /**
     * @param string $view
     * @return string
     */
    public function render($view = ''): string
    {
        if (!empty($view)) {
            $this->_view = $view;
        }

        $autoloader = \Config\Services::autoloader();
        $viewFile = realpath($autoloader->getNamespace($this->_reflectionClass->getNamespaceName())[0]) . '/Views/' . $this->_view . '.php';

        $baseDir = $this->_reflectionClass->getNamespaceName();
        if (!file_exists($viewFile)) {
            $parents = class_parents($this);
            foreach ($parents as $parent) {
                $reflection = new \ReflectionClass($parent);
                $viewFile = realpath($autoloader->getNamespace($reflection->getNamespaceName())[0]) . '/Views/' . $this->_view . '.php';
                if (file_exists($viewFile)) {
                    $baseDir = $reflection->getNamespaceName();
                    break;
                }
            }
        }

        return view($baseDir . '\Views\\' . $this->_view, [
            'data' => $this->data
        ]);
    }
}
