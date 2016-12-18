<?php

use Illuminate\Support\Facades\DB;

class ClientRepository {

    public function add(array $data) 
    {
        $pdo = DB::getPdo();

        $sql = "CALL client_add(:name, :country, :city, :currencys, @uid, @status)";
        $stmt = $pdo->prepare($slq);
        $stmt->bindParam()
    }


}