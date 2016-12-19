<?php

namespace App\Models;

interface RateContract {
    public function getRateValue();
    public function getRateCurrency();
    public function getRateDate();

    public function setRateValue($value);
    public function setRateCurrency($currency);
    public function setRateDate($date);
}