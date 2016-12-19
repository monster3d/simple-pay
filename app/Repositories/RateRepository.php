<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\RateContract;
use \PDO;
use \Exception;

class RateRepository {

    /**
    *
    * Set exchange rate
    *
    * @param $model App\Models\RateContract
    *
    * @return App\Models\RateContract
    *
    */
    public function add(RateContract $model)
    {
         $pdo   = DB::getPdo();
         $value = $model->toSmallAmount($model->getRateValue());
         $alias = $model->getRateCurrency();
         $date  = $model->getRateDate(); 

         $sql = "INSERT INTO `exchange_rates_to_usd` (`currency_id`, `value`, `date`)
                 VALUES ((
                     SELECT `id` 
                     FROM `currencys`
                     WHERE `alias` = :currency_alias LIMIT 1
                     ), :rate_value, :rate_date)";

         $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
         $stmt->bindParam(':currency_alias', $alias, PDO::PARAM_STR);
         $stmt->bindParam(':rate_value', $value, PDO::PARAM_STR);
         $stmt->bindParam(':rate_date', $date, PDO::PARAM_STR);
         $stmt->execute();

         $result = $stmt->rowCount();
                     
         if ($result === 0) {
             throw new Exception('Failed to add the exchange rate');
         }

         return $model;
    }
}