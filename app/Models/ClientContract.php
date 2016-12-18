<?php

namespace App\Models;

interface ClientContract {
    public function getName();
    public function getCountry();
    public function getCity();
    public function getUid();
    public function getId();
    public function getCurrency();

    public function setName($name);
    public function setCountry($country);
    public function setCity($city);
    public function setUid($uid);
    public function setId($id);
    public function setCurrency($currency);
}