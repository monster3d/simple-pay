<?php

use Phinx\Migration\AbstractMigration;

class CurrencyTable extends AbstractMigration
{

    /**
    *
    * Create table currencys
    *
    */
    public function up()
    {
        $sql = "CREATE TABLE `currencys` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `alias` varchar(255) NOT NULL,
                              PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        $this->execute($sql);
    }

    /**
    *
    * Remove table currencys
    *
    */
    public function down()
    {
        $sql = "DROP TABLE `currencys`";
        $this->execute($sql);
    }
    
}
