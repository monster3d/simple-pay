<?php

namespace App\Models;

interface ClientContract {
    /**
    *
    * Get client name
    *
    */
    public function getName();
    
    /**
    *
    * Get client country
    *
    */
    public function getCountry();
    
    /**
    *
    * Get client city
    *
    */
    public function getCity();
    
    /**
    *
    * Get client uid (private purse)
    *
    */
    public function getUid();
    
    /**
    *
    * Get client currency
    *
    */
    public function getCurrency();

    /**
    *
    * Set client name
    *
    * @param $name string
    *
    */
    public function setName($name);

    /**
    *
    * Set client country
    *
    * @param $country string
    *
    */
    public function setCountry($country);
    
    /**
    *
    * Set client city
    *
    * @param $city string
    *
    */
    public function setCity($city);
    
    /**
    *
    * Set client private uid
    *
    * @param $uid int
    *
    */
    public function setUid($uid);

    /**
    *
    * Set client currency
    *
    * @param string
    *
    */
    public function setCurrency($currency);
}