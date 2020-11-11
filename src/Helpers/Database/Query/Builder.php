<?php namespace CI4Xpander\Helpers\Database\Query;

use CodeIgniter\Database\BaseBuilder;

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

    public static function forceQueryToString($query = null, ...$params)
    {
        if (is_a($query, BaseBuilder::class)) {
            $query = $query->getCompiledSelect();
        } elseif (is_callable($query)) {
            $query = $query(...$params);
        }

        if (!is_string($query)) {
            $query = self::forceQueryToString($query, ...$params);
        }

        return $query;
    }

    public static function fromJSON(\CodeIgniter\Database\BaseBuilder $query, $condition)
    {
        if (isset($condition->select)) {
            $query = self::_doSelect($query, (array) $condition->select);
        }

        if (isset($condition->where)) {
            $query = self::_doWhere($query, (array) $condition->where);
        }

        return $query;
    }

    private static function _doSelect(\CodeIgniter\Database\BaseBuilder $query, $select = [])
    {
        foreach ($select as $s) {
            $query->select($s);
        }

        return $query;
    }

    private static function _doWhere(\CodeIgniter\Database\BaseBuilder $query, $where = [])
    {
        foreach ($where as $conCol => $val) {
            $exConCol = explode(':', $conCol);
            if (is_object($val)) {
                $or = false;
                if (count($exConCol) == 2) {
                    if ($exConCol[0] == 'OR') {
                        $or = true;
                    }
                }

                if ($or) {
                    $query->orGroupStart();
                } else {
                    $query->groupStart();
                }

                $query = self::_doWhere($query, (array) $val);

                $query->groupEnd();
            } else {
                if (count($exConCol) == 1) {
                    $query->where($exConCol[0], $val);
                } elseif (count($exConCol) == 2) {
                    if ($exConCol[1] == 'LIKE') {
                        $query->like($exConCol[0], $val);
                    } elseif ($exConCol[1] == 'ILIKE') {
                        $query->like(Builder::protect($exConCol[0]), $val, 'both', null, true);
                    } elseif ($exConCol[0] == 'OR') {
                        $query->orWhere($exConCol[1], $val);
                    } elseif ($exConCol[1] == 'NOT') {
                        $query->where("{$exConCol[0]} !=", $val);
                    }
                } elseif (count($exConCol) == 3) {
                    if ($exConCol[2] == 'LIKE') {
                        if ($exConCol[0] == 'OR') {
                            $query->orLike($exConCol[1], $val);
                        } else {
                            $query->like($exConCol[1], $val);
                        }
                    } elseif ($exConCol[2] == 'ILIKE') {
                        if ($exConCol[0] == 'OR') {
                            $query->orLike(Builder::protect($exConCol[1]), $val, 'both', null, true);
                        } else {
                            $query->like(Builder::protect($exConCol[1]), $val, 'both', null, true);
                        }
                    }
                }
            }
        }

        return $query;
    }
}
