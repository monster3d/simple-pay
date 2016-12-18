<?php

namespace App\Models;

interface TransferContract {
    public function getFromUid();
    public function getToUid();
    public function getSum();

    public function setFromUid($fromUid);
    public function setToUid($toUid);
    public function setSum($sum);
}