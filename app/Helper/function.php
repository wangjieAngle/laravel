<?php
/**
 * Created by PhpStorm.
 * User: clown
 * Date: 2018/9/12
 * Time: 10:33
 */

if (!function_exists('object_to_array')) {
    function object_to_array($obj)
    {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)object_to_array($v);
            }
        }

        return $obj;
    }
}