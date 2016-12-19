<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\ClientContract;
use \PDO;
use \Exception;

class ClientRepository {

    /**
    *
    * Add client to database
    *
    * @param $model App/Models/ClientContract
    *
    * @return App/Models/ClientContract
    *
    */
    public function add(ClientContract $model) 
    {
        $pdo    = DB::getPdo();
        $status = null;
        $uid    = null; 
        $result = false;
        
        $sql = "CALL client_add(:client_name, :client_country, :client_city, :client_currency)";
        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false]);

        $name     = $model->getName();
        $country  = $model->getCountry();
        $city     = $model->getCity();
        $currency = $model->getCurrency();
        
        $stmt->bindParam(':client_name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':client_country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':client_city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':client_currency', $currency, PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['_status'] !== 0) {
            throw new Exception('Сould not create a client');
        }

        $model->setUid($result['client_uid']);
        return $model;
    }

    /**
    *
    * Get client infoermation bey uid
    *
    * @param $model App/Models/ClientContract
    *
    * @return App/Models/ClientContract
    *
    */
    public function get(ClientContract $model)
    {
        $pdo = DB::getPdo();

        $uid = $model->getUid();

        $sql = "SELECT `clients`.`id`, `clients`.`name`, `clients`.`country`, 
                `clients`.`city`, `clients`.`active_at`, `wallets`.`amount`, `currencys`.`alias` 
                FROM `clients`
	            LEFT JOIN `wallets` ON `client_id` = `clients`.`id`
	            LEFT JOIN `currencys` ON `currencys`.`id` = `wallets`.`currency_id`
	            WHERE `uid` = :uid LIMIT 1";

        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new Exception(sprintf('Client not found, uid: %d', $uid));
        }
        $model->setName($result['name'])->setCountry($result['country'])->setCity($result['city'])
              ->setCurrency($result['alias'])->setAmount($model->toBigAmount($result['amount']))->setActivity($result['active_at']);
        
        return $model;
    }

    /**
    *
    * Fill up client purse
    *
    * @param $model App/Models/ClientContract
    *
    * @return App/Models/ClientContract
    *
    */
    public function fillUp(ClientContract $model)
    {
        $pdo = DB::getPdo();

        $status = null;
        $uid = $model->getUid();
        $amount = $model->toSmallAmount($model->getAmount());

        $sql = "CALL fill_up(:uid, :amount)";
        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false]);
        
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new Exception(sprintf('It is impossible to fill up the purse UID: %d', $uid));
        }
        return $model; 
    }
}