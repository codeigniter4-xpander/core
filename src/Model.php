<?php

namespace CI4Xpander;

class Model extends \CodeIgniter\Model
{
    protected $primaryKey = 'id';
    protected $useSoftDelete = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    /**
     * @var bool
     */
    protected $withSchema = false;

    /**
     * @var ReflectionClass[]
     */
    protected $_savedEntityReflection = [];

    /**
     * @return self
     */
    public function withSchema()
    {
        if (defined("{$this->returnType}::SCHEMA")) {
            $this->select("{$this->table}.*");

            $this->_buildSchema(constant("{$this->returnType}::SCHEMA"), [
                '$name' => $this->table
            ]);
        }

        return $this;
    }

    protected function _buildSchema($schema = [], $options = [])
    {
        foreach ($schema as $name => $definition) {
            $entity = array_shift($definition);

            $source = 'id';
            if (array_key_exists('$source', $definition)) {
                $source = $definition['$source'];
                unset($definition['$source']);
            }

            $target = 'id';
            if (array_key_exists('$target', $definition)) {
                $target = $definition['$target'];
                unset($definition['$target']);
            }

            $sourceName = $options['$name'];
            $alias = "{$sourceName}_{$name}";

            if (!array_key_exists($entity, $this->_savedEntityReflection)) {
                $entityReflection = new \ReflectionClass($entity);
                $this->_savedEntityReflection[$entity] = $entityReflection;
            } else {
                $entityReflection = $this->_savedEntityReflection[$entity];
            }

            foreach ($entityReflection->getDefaultProperties()['casts'] as $fieldName => $fieldType) {
                $this->select("{$alias}.{$fieldName} {$alias}_{$fieldName}");
            }

            $this->join("{$name} {$alias}", "{$alias}.{$target} = {$sourceName}.{$source}", 'left');

            $this->_buildSchema($definition, [
                '$name' => $alias,
            ]);
        }
    }
}
