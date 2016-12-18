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
    */
    public function report($fromDate, $toDate)
    {
        $pdo = DB::getPdo();

        $sql = "SELECT `clients`.`name`, `clients`.`uid`, `clients`.`country`, `actions`.`alias`, 
                        `logs`.`value`, `logs`.`action_date` 
                FROM `logs` 
                LEFT JOIN `clients` ON `logs`.`client_id` = `clients`.`id`
                LEFT JOIN `wallets` ON `logs`.`client_id` = `wallets`.`client_id`
                LEFT JOIN `actions` ON `logs`.`action_id` = `actions`.`id`
                WHERE (`logs`.`action_date` BETWEEN :date_from AND :date_to)";
    
        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true]);
        $stmt->bindParam(':date_from', $fromDate, PDO::PARAM_STR);
        $stmt->bindParam(':date_to', $toDate, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result === false) {
            throw new Exception('Unable to get report');
        }
        return $result;
    }
}