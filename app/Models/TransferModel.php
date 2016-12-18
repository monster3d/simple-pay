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

    public function __construct($data = null)
    {
        if ($data !== null) {
            $this->fromUid = (int)$this->getValue($data, 'from_uid', 0);
            $this->toUid   = (int)$this->getValue($data, 'to_uid', 0);
            $this->sum     = (int)$this->getValue($data, 'sum', 0); 
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
    }
}