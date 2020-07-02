<?php namespace CI4Xpander\Helpers;

class Input
{
    public static function filter($in = [], $filter = '', $rename = true, $defaultValue = true)
    {
        $filteredInput = array_filter($in, function ($value, $key) use ($filter) {
            return \Stringy\StaticStringy::startsWith($key, $filter);
        }, ARRAY_FILTER_USE_BOTH);

        $result = [];
        array_walk($filteredInput, function ($value, $key) use (&$result, $filter, $rename, $defaultValue) {
            if ($defaultValue) {
                $value = \CI4Xpander\Helpers\DefaultValue::for($value);
            }

            if ($rename) {
                $key = str_replace($filter, '', $key);
            }

            if (!is_null($value)) {
                $result[$key] = $value;
            }
        });

        return $result;
    }
}