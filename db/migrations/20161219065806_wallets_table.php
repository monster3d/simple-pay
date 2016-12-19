<?php

use Phinx\Migration\AbstractMigration;

class WalletsTable extends AbstractMigration
{
    /**
    *
    * Create table wallets
    *
    */
    public function up()
    {
        $sql = "CREATE TABLE `wallets` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `currency_id` int(11) NOT NULL,
                             `client_id` int(11) NOT NULL,
                             `amount` int(11) unsigned NOT NULL,
                             PRIMARY KEY (`id`),
                             KEY `client_id` (`client_id`),
                             KEY `wallet_id` (`currency_id`),
                             KEY `currency_id` (`currency_id`),
               CONSTRAINT `wallets_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
               CONSTRAINT `wallets_ibfk_3` FOREIGN KEY (`currency_id`) REFERENCES `currencys` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        
        $this->execute($sql);
    }

    /**
    *
    * Remove table wallets
    *
    */
    public function down()
    {
        $sql = "DROP TABLE `wallets`";
        $this->execute($sql);
    }
}
