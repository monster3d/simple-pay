<?php

namespace App\Models;

class BaseModel {
    
   /**
    *
    * Prepare amount, to turn into a small unit
    *
    * @param $amount int
    *
    * @return int
    *
    */
    public function toSmallAmount($amount){
        $result = 0;
        
        if ($amount !== 0) {
            $result = $amount * 100;  
        }
        return $result;
    }

    /**
    *
    * To trun into a big unit
    *
    * @param $amount int
    *
    * @return int
    *
    */
    public function toBigAmount($amount)
    {
        $result = 0;

        if ($amount !== 0) {
            $result = $amount / 100;
        }
        return $result;
    }

    /**
    *
    * Get array value
    *
    * @param $array array
    * @param $key string
    * @param $default mixed
    * @param $strict bool
    *
    * @return mixed
    *
    */
    public function getValue($array, $key, $default, $strict = false)
    {
        $result = null;

        if (array_key_exists($key, $array)) {
            $result = $array[$key];
        } else {
            if ($strict === true) {
                throw new Exception('Value not found');
            }
            $result = $default;
        }
        return $result;
    }
}