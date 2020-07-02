<?php namespace CI4Xpander\Helpers;

class DefaultValue {
    public static function for($input = null, $default = null, $condition = null)
    {
        $return = $input;
        $setDefault = true;
        
        if (isset($input)) {
            if (!is_null($input)) {
                if (is_bool($input)) {
                    $setDefault = false;
                } elseif (is_numeric($input)) {
                    $setDefault = false;
                } else {
                    if (!empty($input)) {
                        $setDefault = false;
                    }
                }
            }
        }

        if (!is_null($condition)) {
            if (is_callable($condition)) {
                $setDefault = $condition($return, $default, $setDefault);
            }
        }

        if ($setDefault) {
            $return = $default;
        }

        return $return;
    }
}