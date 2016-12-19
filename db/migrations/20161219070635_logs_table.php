<?php

use Phinx\Migration\AbstractMigration;

class LogsTable extends AbstractMigration
{
    /**
    *
    * Create table logs
    *
    *
    */
    public function up() 
    {
        $sql = "CREATE TABLE `logs` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `client_id` int(11) NOT NULL,
                             `action_id` int(11) NOT NULL,
                             `action_date` datetime NOT NULL,
                             `value` int(11) unsigned NOT NULL,
                             PRIMARY KEY (`id`),
                             KEY `action_id` (`action_id`),
                             KEY `client_id` (`client_id`),
                 CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
                 ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        $this->execute($sql);
    }

    /**
    *
    * Remove table logs
    *
    */        
    public function down()
    {
        $sql = "DROP TABLE `logs`";
        $this->execute($sql);
    }
}
