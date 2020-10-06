<?php namespace CI4Xpander\Helpers;

class Array_ {
    public static function insertBefore($key, $array, $value) {
        if (!is_array($value)) {
            $value = [$value];
        }

        if (array_key_exists($key, $array)) {
            $arrayKeyIndex = array_search($key, array_keys($array));
            $array = array_slice($array, 0, $arrayKeyIndex, true) + $value + array_slice($array, $arrayKeyIndex, count($array) - ($arrayKeyIndex), true);
        }

        return $array;
    }

    public static function insertAfter($key, $array, $value) {
        if (!is_array($value)) {
            $value = [$value];
        }

        if (array_key_exists($key, $array)) {
            $arrayKeyIndex = array_search($key, array_keys($array));
            $array = array_slice($array, 0, $arrayKeyIndex + 1, true) + $value + array_slice($array, $arrayKeyIndex + 1, count($array) - ($arrayKeyIndex + 1), true);
        }

        return $array;
    }
}
