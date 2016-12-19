<?php


namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use \PDO;
use \Exception;

class ReportRepository {

    /**
    *
    * Get report (all data)
    *
    * @return array
    *
    */
    public function all()
    {
        $pdo = DB::getPdo();

        $sql = "SELECT `clients`.`name`, `clients`.`uid`, `currencys`.`alias` AS `currency`, `clients`.`country`, 
                        `actions`.`alias` AS `action`, (`logs`.`value` / 100) AS `sum_value`, `logs`.`action_date`,
                         IF(`rate`.`date` IS NOT NULL, ((`logs`.`value` / `rate`.`value`)), null) AS `curs` 
                FROM `logs` 
                LEFT JOIN `clients` ON `logs`.`client_id` = `clients`.`id`
                LEFT JOIN `wallets` ON `logs`.`client_id` = `wallets`.`client_id`
                LEFT JOIN `actions` ON `logs`.`action_id` = `actions`.`id`
                LEFT JOIN `currencys` ON `wallets`.`currency_id` = `currencys`.`id`
                LEFT JOIN `exchange_rates_to_usd` AS `rate` ON `currencys`.`id` IN(`rate`.`currency_id`)
                AND `rate`.`date` = CURDATE()";
    
        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result === false) {
            throw new Exception('Unable to get report');
        }
        return $result;
    }

    /**
    *
    * Get report by name
    *
    * @param $name string
    * 
    * @return array
    *
    */
    public function byName($name)
    {
        $pdo = DB::getPdo();

        $sql = "SELECT `clients`.`name`, `clients`.`uid`, `currencys`.`alias` AS `currency`, `clients`.`country`, 
                        `actions`.`alias` AS `action`, (`logs`.`value` / 100) AS `sum_value`, `logs`.`action_date`,
                         IF(`rate`.`date` IS NOT NULL, ((`logs`.`value` / `rate`.`value`)), null) AS `curs`
                FROM `logs` 
                LEFT JOIN `clients` ON `logs`.`client_id` = `clients`.`id`
                LEFT JOIN `wallets` ON `logs`.`client_id` = `wallets`.`client_id`
                LEFT JOIN `actions` ON `logs`.`action_id` = `actions`.`id`
                LEFT JOIN `currencys` ON `wallets`.`currency_id` = `currencys`.`id`
                LEFT JOIN `exchange_rates_to_usd` AS `rate` ON `currencys`.`id` IN(`rate`.`currency_id`)
                AND `rate`.`date` = CURDATE()
                WHERE `clients`.`name` LIKE :name";

        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception('Error, not execute search client');
        }

        return $result;
    }

    /**
    *
    * Get report by name and from date
    *
    * @param $name string
    * @param $fromDate string
    * 
    * @return array
    *
    */
    public function byDateFrom($name, $fromDate)
    {
        $pdo = DB::getPdo();

        $sql = "SELECT `clients`.`name`, `clients`.`uid`, `currencys`.`alias` AS `currency`, `clients`.`country`, 
                        `actions`.`alias` AS `action`, (`logs`.`value` / 100) AS `sum_value`, `logs`.`action_date`,
                         IF(`rate`.`date` IS NOT NULL, ((`logs`.`value` / `rate`.`value`)), null) AS `curs` 
                FROM `logs` 
                LEFT JOIN `clients` ON `logs`.`client_id` = `clients`.`id`
                LEFT JOIN `wallets` ON `logs`.`client_id` = `wallets`.`client_id`
                LEFT JOIN `actions` ON `logs`.`action_id` = `actions`.`id`
                LEFT JOIN `currencys` ON `wallets`.`currency_id` = `currencys`.`id`
                LEFT JOIN `exchange_rates_to_usd` AS `rate` ON `currencys`.`id` IN(`rate`.`currency_id`)
                AND `rate`.`date` = CURDATE()
                WHERE `clients`.`name` LIKE :name
                AND `logs`.`action_date` > :date_from";

        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':date_from', $fromDate, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception('Error, not execute search client');
        }

        return $result;
    }

    /**
    *
    * Get report by name and to date
    *
    * @param $name string
    * @param $toDate string
    * 
    * @return array
    *
    */
    public function byDateTo($name, $toDate)
    {
        $pdo = DB::getPdo();

        $sql = "SELECT `clients`.`name`, `clients`.`uid`, `currencys`.`alias` AS `currency`, `clients`.`country`, 
                        `actions`.`alias` AS `action`, (`logs`.`value` / 100) AS `sum_value`, `logs`.`action_date`,
                         IF(`rate`.`date` IS NOT NULL, ((`logs`.`value` / `rate`.`value`)), null) AS `curs`
                FROM `logs` 
                LEFT JOIN `clients` ON `logs`.`client_id` = `clients`.`id`
                LEFT JOIN `wallets` ON `logs`.`client_id` = `wallets`.`client_id`
                LEFT JOIN `actions` ON `logs`.`action_id` = `actions`.`id`
                LEFT JOIN `currencys` ON `wallets`.`currency_id` = `currencys`.`id`
                LEFT JOIN `exchange_rates_to_usd` AS `rate` ON `currencys`.`id` IN(`rate`.`currency_id`)
                AND `rate`.`date` = CURDATE()
                WHERE `clients`.`name` LIKE :name
                AND `logs`.`action_date` < :date_to";

        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':date_to', $toDate, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception('Error, not execute search client');
        }

        return $result;
    }

     /**
    *
    * Get report by name and between date
    *
    * @param $name string
    * @param $toDate string
    * 
    * @return array
    *
    */
    public function byBetweenDate($name, $fromDate, $toDate)
    {
        $pdo = DB::getPdo();

        $sql = "SELECT `clients`.`name`, `clients`.`uid`, `currencys`.`alias` AS `currency`, `clients`.`country`, 
                        `actions`.`alias` AS `action`, (`logs`.`value` / 100) AS `sum_value`, `logs`.`action_date`,
                         IF(`rate`.`date` IS NOT NULL, ((`logs`.`value` / `rate`.`value`)), null) AS `curs` 
                FROM `logs` 
                LEFT JOIN `clients` ON `logs`.`client_id` = `clients`.`id`
                LEFT JOIN `wallets` ON `logs`.`client_id` = `wallets`.`client_id`
                LEFT JOIN `actions` ON `logs`.`action_id` = `actions`.`id`
                LEFT JOIN `currencys` ON `wallets`.`currency_id` = `currencys`.`id`
                LEFT JOIN `exchange_rates_to_usd` AS `rate` ON `currencys`.`id` IN(`rate`.`currency_id`)
                AND `rate`.`date` = CURDATE()
                WHERE `clients`.`name` LIKE :name
                AND (`logs`.`action_date` BETWEEN :date_from AND :date_to)";

        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':date_from', $fromDate, PDO::PARAM_STR);
        $stmt->bindParam(':date_to', $toDate, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            throw new Exception('Error, not execute search client');
        }

        return $result;
    }
}