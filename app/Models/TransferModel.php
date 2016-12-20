<?php

namespace App\Models;

class TransferModel extends BaseModel implements TransferContract {
    
    /**
    *
    * From Uid
    *
    * @var int
    *
    */
    private $fromUid;
    
    /**
    *
    * To Uid
    *
    * @var int
    *
    */
    private $toUid;
    
    /**
    *
    * Sum
    *
    * @var int
    *
    */
    private $sum;

    /**
    *
    * From currency alias
    *
    * @var string
    *
    */
    private $formCurrency;

    /**
    *
    * To currency alias
    *
    * @var string
    *
    */
    private $toCurrency;

    /**
    *
    * Transfer status
    *
    * @var int
    *
    */
    private $status;

    public function __construct($data = null)
    {
        if ($data !== null) {
            $this->fromUid      = (int)$this->getValue($data, 'from_uid', 0);
            $this->toUid        = (int)$this->getValue($data, 'to_uid', 0);
            $this->fromCurrency = (string)$this->getValue($data, 'currency', '');
            $this->toCurrency   = (string)$this->getValue($data, 'currency', '');
            $this->sum          = (int)$this->getValue($data, 'sum', 0); 
        }
    }

    /**
    *
    * Get from uid
    *
    * @return int
    *
    */
    public function getFromUid()
    {
        return $this->fromUid;
    }

    /**
    *
    * Get to uid
    *
    * @return int
    *
    */
    public function getToUid()
    {
        return $this->toUid;
    }

    /**
    *
    * Get from currency alias
    *
    * @return string
    *
    */
    public function getFromCurrency()
    {
        return $this->fromCurrency;
    }

    /**
    *
    * Get to cyrrency alias
    *
    *
    */
    public function getToCurrency()
    {
        return $this->toCurrency;
    }

    /**
    *
    * Get sum
    *
    * @return int
    *
    */
    public function getSum()
    {
        return $this->sum;
    }

    /**
    *
    * Get current transfer status
    *
    * @return int
    *
    */
    public function getStatus()
    {
        return $this->status;
    }

    /**
    *
    * Set from uid
    *
    * @param $fromUid
    *
    * @return self
    *
    */
    public function setFromUid($fromUid)
    {
        $this->fromUid = (int)$fromUid;
        return $this;
    }

    /**
    *
    * Set to uid
    *
    * @param $toUid
    *
    * @return self
    *
    */
    public function setToUid($toUid)
    {
        $this->toUid = (int)$toUid;
        return $this;
    }

    /**
    *
    * Set from currency alias
    *
    * @param $fromCurrency string
    *
    * @return self
    *
    */
    public function setFromCurrency($fromCurrency)
    {
        $this->fromCurrency = (string)$fromCurrency;
        return $this;
    }

    /**
    *
    * Set to currency alias
    *
    * @param $toCurrency string
    *
    * @return self
    *
    */
    public function setToCurrency($toCurrency)
    {
        $this->toCurrency = (string)$toCurrency;
        return $this;
    }

    /**
    *
    * Set sum
    *
    * @param $sum int
    *
    * @return self
    *
    */
    public function setSum($sum)
    {
        $this->sum = (int)$sum;
        return $this;
    }

    /**
    *
    * Set transfer status
    *
    * @param $status int
    *
    * @return self
    *
    */
    public function setStatus($status)
    {
        $this->status = (int)$status;
        return $this;
    }
}