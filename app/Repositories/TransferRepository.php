<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\TransferContract;
use \PDO;
use \Exception;

class TransferRepository {

    /**
    *
    * Transfer money from client to client
    *
    * @param 
    *
    */
    public function clientToClient(TransferContract $model)
    {
        $pdo = DB::getPdo();
        $status  = null;
        $result  = false;                
        $fromUid = $model->getFromUid();
        $toUid   = $model->getToUid();
        $sum     = $model->toSmallAmount($model->getSum());

        $sql  = "SELECT get_amount(:uid) AS `amount`";
        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false]);

        $stmt->bindParam(':uid', $fromUid, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($sum > $result['amount']) {
            throw new Exception(sprintf('Not enough money in the uid: %d', $fromUid));
        }

        $result = false;

        $sql  = "CALL pay_to_pay(:from_uid, :to_uid, :sum, :_status)";
        $stmt = $pdo->prepare($sql, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false]);
        
        $stmt->bindParam(':from_uid', $fromUid, PDO::PARAM_INT);
        $stmt->bindParam(':to_uid', $toUid, PDO::PARAM_INT);
        $stmt->bindParam(':sum', $sum, PDO::PARAM_INT);
        $stmt->bindParam(':_status', $status, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4000);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result === false) {
            throw new Exception('Transfer error');
        }
        return $model;
    }
}