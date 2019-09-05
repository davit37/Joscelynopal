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

    function is_in_array($array, $key, $key_value){
        $within_array = 'no';
        foreach( $array as $k=>$v ){
          if( is_array($v) ){
              $within_array = is_in_array($v, $key, $key_value);
              if( $within_array == 'yes' ){
                  break;
              }
          } else {
                  if( $v == $key_value && $k == $key ){
                          $within_array = 'yes';
                          break;
                  }
          }
        }
        return $within_array;
  }