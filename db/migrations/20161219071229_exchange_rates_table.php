<?php

use Phinx\Migration\AbstractMigration;

class ExchangeRatesTable extends AbstractMigration
{
    /**
    *
    * Create table exchange_rates_to_usd
    *
    */
    public function up()
    {
        $sql = "CREATE TABLE `exchange_rates_to_usd` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `currency_id` int(11) NOT NULL,
                             `value` int(11) NOT NULL,
                             `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              PRIMARY KEY (`id`),
                              KEY `currency_id` (`currency_id`),
                        CONSTRAINT `exchange_rates_to_usd_ibfk_1` FOREIGN KEY (`currency_id`) REFERENCES `currencys` (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        $this->execute($sql);
    }

    /**
    *
    * Remove table exchange_rates_to_usd
    *
    */
    public function down()
    {
        $sql = "DROP TABLE `exchange_rates_to_usd`";
        $this->execute($sql);
    }
       
}
