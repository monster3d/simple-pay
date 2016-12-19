<?php

use Phinx\Migration\AbstractMigration;

class ActionsTable extends AbstractMigration
{
    /**
    *
    * Create table actions
    *
    */
    public function up()
    {
        $sql = "CREATE TABLE `actions` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `alias` varchar(255) NOT NULL,
                              PRIMARY KEY (`id`)
                              ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

        $this->execute($sql);

        $sql = "INSERT INTO `actions` (`alias`) VALUES('addition'), ('subtraction')";
        $this->execute($sql);
    }

    /**
    *
    * Remove table actions
    *
    */
    public function down()
    {
        $sql = "DROP TABLE `actions`";
        $this->execute($sql);
    }
}
