<?php

namespace App\Models;

interface RateContract {
    /**
    *
    * Get rate value
    *
    */
    public function getRateValue();
    
    /**
    *
    * Get rate current currency
    *
    */
    public function getRateCurrency();
    
    /**
    *
    * Get rate actual date
    *
    */
    public function getRateDate();

    /**
    *
    * Set rate value (amount)
    *
    * @param $value int
    *
    */
    public function setRateValue($value);
    
    /**
    *
    * Set rate currency
    *
    * @param $currency string
    *
    */
    public function setRateCurrency($currency);

    /**
    *
    * Set actuale date
    *
    * @param $date string
    *
    */
    public function setRateDate($date);
}