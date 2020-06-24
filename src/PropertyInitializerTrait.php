<?php namespace CI4Xpander;

trait PropertyInitializerTrait
{
    use \CI4Xpander\ReflectionClassTrait, \CI4Xpander\DocBlockTrait;

    protected function _initProperty()
    {
        $parents = class_parents($this);

        foreach ($this->_reflectionClass->getProperties() as $property) {
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
                    if ($property->class == $this->_reflectionClass->getName()) {
                        $propertyDoc = $this->_docBlockFactory->create($property->getDocComment());
                        foreach ($propertyDoc->getTagsByName('var') as $var) {
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
                    if ($property->hasType()) {
                        $class = $property->getType()->getName();
                    }
                }

                if (is_null($class)) {
                    foreach ($parents as $parent) {
                        $parentReflection = new \ReflectionClass($parent);
                        if ($parentReflection->hasProperty($property->getName())) {
                            $parentProperty = $parentReflection->getProperty($property->getName());

                            if ($parentProperty->getDocComment() != false) {
                                if ($parentProperty->class == $parentReflection->getName()) {
                                    $parentPropertyDoc = $this->_docBlockFactory->create($parentProperty->getDocComment());
                                    foreach ($parentPropertyDoc->getTagsByName('var') as $var) {
                                        if (method_exists($var->getType(), 'getFqsen')) {
                                            $class = strval($var->getType()->getFqsen());
                                        }
                                    }
                                }
                            }
            
                            if (is_null($class)) {
                                if ($parentReflection->getDocComment() != false) {
                                    $classDoc = $this->_docBlockFactory->create($parentReflection->getDocComment());
                                    foreach ($classDoc->getTagsByName('property') as $p) {
                                        if ($p->getVariableName() == $parentProperty->name) {
                                            $class = strval($p->getType()->getFqsen());
                                        }
                                    }
                                }
                            }
            
                            if (is_null($class)) {
                                if ($parentProperty->hasType()) {
                                    $class = $parentProperty->getType()->getName();
                                }
                            }
                        }

                        if (!is_null($class)) {
                            break;
                        }
                    }
                }

                if (!is_null($class)) {
                    if (class_exists($class)) {
                        $this->{$property->name} = new $class();
                    }
                }
            }
        }
    }
}
