<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use \PDO;

class ClientRepository {

    public function add($model) 
    {
        $pdo    = DB::getPdo();
        $status = null;
        $uid    = null; 
        
        $sql = "CALL client_add(:name, :country, :city, :currency, :uid, :_status)";
        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false]);

        $name     = $model->getName();
        $country  = $model->getCountry();
        $city     = $model->getCity();
        $currency = $model->getCurrency();
        
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4000);
        $stmt->bindParam(':_status', $status, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4000);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['_status'] !== 0) {
            throw new Exception('Сould not create a client');
        }

        $model->setUid($result['uid']);
        return $model;
    }


}