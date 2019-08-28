<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function asso_count(array $arr, $property, $value){

        $final = array_filter($arr, function($a) use($property, $value) {
            return $a[$property] == $value;
         });
    
        return count($final);
    }

    function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }