<?php namespace CI4Xpander\Helpers\Database;

class Builder {
    public static function select($table = '', $fields = [], $prefix = true) {
        $doPrefix = true;

        if (is_bool($prefix)) {
            $doPrefix = $prefix;
            $prefix = $table;
        } elseif (is_string($prefix)) {
            if (empty($prefix)) {
                $doPrefix = false;
            } else {
                $doPrefix = true;
            }
        } elseif (is_array($prefix)) {

        } else {
            $doPrefix = false;
        }

        $result = [];

        foreach ($fields as $key => $field) {
            $f = $field;
            if (!is_numeric($key)) {
                $f = $key;
            }

            if ($doPrefix) {
                $prefixedField = $table . '.' . $f . ' ' . $prefix . '_' . $field;
            } else {
                $prefixedField = $table . '.' . $f . ' ' . $field;
            }

            $result[] = $prefixedField;
        }

        return $result;
    }

    public static function escape($value = '')
    {
        return \Config\Database::connect()->escape($value);
    }

    public static function protect($identifier = '')
    {
        return \Config\Database::connect()->protectIdentifiers($identifier);
    }

    public static function subQuery($query, $alias)
    {
        if (is_a($query, \CodeIgniter\Database\BaseBuilder::class)) {
            $query = $query->getCompiledSelect();
        }

        return "({$query}) {$alias}";
    }
}