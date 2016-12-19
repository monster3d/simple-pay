<?php

namespace App\Models;

class RateModel extends BaseModel implements RateContract {
    
    /**
    *
    * Value rate to USD
    *
    * @var int
    *
    */
    private $value;
    
    /**
    *
    * Alias currency
    *
    * @var string
    *
    */
    private $currency;
    
    /**
    *
    * Rate date
    *
    */
    private $date;

    public function __construct($data = null)
    {
        if ($data !== null) {
            $this->value    = (int)$this->getValue($data, 'value', 0);
            $this->currency = (string)$this->getValue($data, 'currency', '');
            $this->date     = (string)$this->getValue($data, 'date', '');
        }
    }
    
    /**
    *
    * Get rate value
    *
    * @return int
    *
    */
    public function getRateValue()
    {
        return $this->value;
    }

    /**
    *
    * Get currency alias
    *
    * @return string
    *
    */
    public function getRateCurrency()
    {
        return $this->currency;
    }

    /**
    *
    * Get reate date
    *
    * @return string
    *
    */
    public function getRateDate()
    {
        return $this->date;
    }

    /**
    *
    * Set Value rate
    *
    * @param $value int
    *
    * @return self
    *
    */
    public function setRateValue($value)
    {
        $this->value = (int)$value;
        return $this; 
    }

    /**
    *
    * Set rate currency alias
    *
    * @param $currency
    *
    * @return self
    *
    */
    public function setRateCurrency($currency)
    {
        $this->currency = (string)$currency;
        return $this;
    }
    
    /**
    *
    * Set date rate
    *
    * @param $date string
    *
    * @return self
    *
    */
    public function setRateDate($date){
        $this->date = (string)$date;
        return $this;
    }
}