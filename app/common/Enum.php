<?php


namespace App\Common;
use Exception;
use ReflectionClass;

class Enum_Exception extends Exception {}

abstract class Enum {

    public static function getValueByNumber($number) {
        $class = new ReflectionClass(get_called_class());
        $values = array_values($class->getConstants())[0];

        if(count($values) > $number)
            return $values[$number];

        return false;         
    }

    public static function getNumberByValue($value, $strict = true) {
        $class = new ReflectionClass(get_called_class());
        $values = array_values($class->getConstants())[0];

        return array_search($value, $values, $strict);
    }

    public static function checkExsist($value, $strict = true) {
        $class = new ReflectionClass(get_called_class());
        $values = array_values($class->getConstants())[0];

        return array_search($value, $values, $strict);
    }


}


