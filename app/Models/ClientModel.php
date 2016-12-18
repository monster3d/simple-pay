<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ClientModel {
    
    /**
    *
    * Client first name
    *
    * @var string
    *
    */
    private $name;

    /**
    *
    * From client
    *
    * @var string
    *
    */
    private $country;
    
    /**
    *
    * Client's city
    *
    * @var string
    *
    */
    private $city;

    /**
    *
    * Client pass hash
    *
    * @var string
    *
    */
    private $passHash;

    /**
    *
    * Client currency
    *
    * @var string
    *
    */
    private $currency;

    /**
    *
    * Client's purse
    *
    * @var int
    *
    */ 
    private $uid;

    /**
    *
    * Client amount
    *
    * @var int
    *
    */
    private $amount;

    /**
    *
    * Last activity
    *
    * @var string
    *
    */
    private $lastActivity;

    public function __construct($data = null)
    {
        if ($data !== null) {
            $this->name     = (string)$this->getValue($data, 'name', '', true);
            $this->country  = (string)$this->getValue($data, 'country', '', true);
            $this->city     = (string)$this->getValue($data, 'city', '', true);
            $this->currency = (string)$this->getValue($data, 'currency', '', true);
            $this->passHash = (string)$this->getValue($data, 'pass_hash', '');
            $this->uid      = (int)$this->getValue($data, 'uid', 0);
        }
    }

    /**
    *
    * Get client name
    *
    * @return string
    *
    */
    public function getName()
    {
        return $this->name;
    }

    /**
    *
    * Get client country
    *
    * @return string
    *
    */
    public function getCountry()
    {
        return $this->country;
    }

    /**
    *
    * Get client city
    *
    * @return string
    *
    */
    public function getCity()
    {
        return $this->city;
    }

    /**
    *
    * Get client currency
    *
    * @return string
    *
    */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
    *
    * Ger client hash
    *
    */
    public function getHash()
    {
        return $this->passHash;
    }

    /**
    *
    * Get client uid 
    *
    * @return int
    *
    */
    public function getUid()
    {
        return empty($this->uid) ? 0 : $this->uid;
    }

    /**
    *
    * Get client amount 
    *
    * @return int
    *
    */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
    *
    * Get client last active
    *
    * @return string
    *
    */
    public function getLastActive()
    {
        return $this->lastActivity;
    }

    /**
    *
    * Set client name
    *
    * @param $name string
    * 
    * @return self
    *
    */
    public function setName($name)
    {
        $this->name = (string)$name;
        return $this;
    }

    /**
    *
    * Set client country
    *
    * @param $country string
    *
    * @return self
    *
    */
    public function setCountry($country)
    {
        $this->country = (string)$country;
        return $this;
    }

    /**
    *
    * Set client city
    *
    * @param $city string
    *
    * @return self
    *
    */
    public function setCity()
    {
        $this->city = (string)$city;
        return $this;
    }

    /**
    *
    * Set client currency
    *
    * @param $currency string
    *
    * @return self
    *
    */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
    *
    * Set client uid
    *
    * @param $uid int
    *
    * @return self
    *
    */
    public function setUid($uid)
    {
        $this->uid = (int)$uid;
        return $this;
    }

    /**
    *
    * Set client last activity
    *
    * @param $activity string
    *
    * @return self
    *
    */
    public function setActivity($activity)
    {
        $this->lastActivity = (string)$activity;
        return $this; 
    }

    /**
    *
    * Check status model
    * 
    * @return bool
    *
    */
    public function getStatus()
    {
        if (empty($this->name)) {
            return false;
        }
        if (empty($this->country)) {
            return false;
        }
        if (empty($this->city)) {
            return false;
        }
        if (empty($this->currency)) {
            return false;
        }
        return true;
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