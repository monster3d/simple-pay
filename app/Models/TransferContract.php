<?php

namespace App\Models;

interface TransferContract {
    /**
    *
    * Get client uid from transfer 
    *
    */
    public function getFromUid();
    
    /**
    *
    * Get client uid to transfer
    *
    */
    public function getToUid();
    
    /**
    *
    * Get sum transfer
    *
    */
    public function getSum();

    /**
    *
    * Set client uid from transfer
    *
    * @param $fromUid int
    *
    */
    public function setFromUid($fromUid);
    
    /**
    *
    * Set client to uid transfer
    *
    * @param $toUid int
    *
    */
    public function setToUid($toUid);
   
    /**
    *
    * Set sum transfer
    *
    */
    public function setSum($sum);
}