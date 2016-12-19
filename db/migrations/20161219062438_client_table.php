<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\Mysql;

class ClientTable extends AbstractMigration
{
    /**
    *
    * Create table clients
    *
    */
    public function up()
    {
        $sql = "CREATE TABLE `clients` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `pass_hash` varchar(32) DEFAULT NULL,
                             `uid` int(11) unsigned NOT NULL,
                             `name` varchar(255) NOT NULL,
                             `country` varchar(255) NOT NULL,
                             `city` varchar(255) NOT NULL,
                             `active_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              PRIMARY KEY (`id`),
                              UNIQUE KEY `uid` (`uid`),
                              UNIQUE KEY `pass_hash` (`pass_hash`),
                              FULLTEXT KEY `name` (`name`)
                                     ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        
        $this->execute($sql);
    }

    /**
    *
    * Remove table clients
    *
    */
    public function down()
    {
        $sql = "DROP TABLE `clients`";
        $this->execute($sql);
    }
    
}
