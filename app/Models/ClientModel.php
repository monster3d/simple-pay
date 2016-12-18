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
    * Client's purse
    *
    * @var int
    *
    */ 
    private $uid;

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
            array_walk($data, function() {
                $this->name     = (string)$data['name'];
                $this->country  = (string)$data['country'];
                $this->city     = (string)$data['city'];
                $this->passHash = (string)$data['pass_hash'];
                $this->uid      = (string)$data['uid'];
            });
        }
    }
}