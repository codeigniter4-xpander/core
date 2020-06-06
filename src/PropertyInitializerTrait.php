<?php

namespace CI4Xpander;

trait PropertyInitializerTrait
{
    use \CI4Xpander\ReflectionClassTrait, \CI4Xpander\DocBlockTrait;

    protected function _initProperty()
    {
        foreach ($this->_reflectionClass->getProperties() as $property) {
            if ($property->hasType()) {
                $property->setAccessible(true);

                $doInitialize = false;
                if ($property->isInitialized($this)) {
                    if (is_null($this->{$property->name})) {
                        $doInitialize = true;
                    }
                } else {
                    $doInitialize = true;
                }

                if ($doInitialize) {
                    $class = null;
                    if ($property->getDocComment() != false) {
                        $propertyDoc = $this->_docBlockFactory->create($property->getDocComment());
                        foreach ($propertyDoc->getTagsByName('var') as $var) {
                            if ($var->getVariableName() == $property->name) {
                                $class = strval($var->getType()->getFqsen());
                            }
                        }
                    }

                    if (is_null($class)) {
                        if ($this->_reflectionClass->getDocComment() != false) {
                            $classDoc = $this->_docBlockFactory->create($this->_reflectionClass->getDocComment());
                            foreach ($classDoc->getTagsByName('property') as $p) {
                                if ($p->getVariableName() == $property->name) {
                                    $class = strval($p->getType()->getFqsen());
                                }
                            }
                        }
                    }

                    if (is_null($class)) {
                        $class = $property->getType()->getName();
                    }

                    $this->{$property->name} = new $class();
                }
            }
        }
    }
}
