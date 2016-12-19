<?php

use Phinx\Migration\AbstractMigration;

class StoredProcedure extends AbstractMigration
{
    public function up()
    {
        $sql = "SET GLOBAL log_bin_trust_function_creators = 1;";
        $this->execute($sql);

        $sql = "DROP PROCEDURE IF EXISTS `client_add`";
        $this->execute($sql);

        $sql = "CREATE PROCEDURE `client_add`(IN client_name VARCHAR(255), IN client_country VARCHAR(255), client_city VARCHAR(255), client_currency VARCHAR(255))
                    BEGIN
	                    DECLARE last_id_currency INT;
                        DECLARE last_id_client INT;
                        DECLARE new_uid INT;
                        DECLARE client_uid INT;
                        DECLARE _status INT;
                        SET _status = -1;
    
                    START TRANSACTION;
    	                INSERT INTO `currencys` (`alias`) VALUES(client_currency);
    	                SET last_id_currency = LAST_INSERT_ID();
    	
                        SELECT ROUND((RAND() * (999999999-111111111))+111111111) INTO new_uid;
    	
                        INSERT INTO `clients` (`uid`, `name`, `country`, `city`)
                        VALUES(new_uid, client_name, client_country, client_city);
                        
                        SET last_id_client = LAST_INSERT_ID();
        
                        INSERT INTO `wallets` (`currency_id`, `client_id`, `amount`)
                        VALUE (last_id_currency, last_id_client, 0); 
                    COMMIT;
                    SET _status = 0;
                    SET client_uid = new_uid;
                    SELECT client_uid, _status;
                    END;";
        
        $this->execute($sql);

        $sql = "DROP PROCEDURE IF EXISTS `fill_up`";
        $this->execute($sql);

        $sql = "CREATE PROCEDURE `fill_up`(IN `client_uid` INT(11), IN `client_amount` INT(11))
                    BEGIN
	                    DECLARE log_client_id INT;
                        DECLARE _status INT DEFAULT 1;
	                    SET SQL_SAFE_UPDATES = 0;

	                    SELECT `id` INTO log_client_id FROM `clients` WHERE `uid` = client_uid;

                        UPDATE `wallets` SET `amount` = `amount` + client_amount WHERE `client_id` = log_client_id;    
    
                        INSERT INTO `logs` (`client_id`, `action_id`, `action_date`, `value`) VALUES(log_client_id, 1, NOW(), client_amount);
                    COMMIT;
                    SET _status = 0;
                    SELECT _status;
                    END;";

        $this->execute($sql);

        $sql = "DROP PROCEDURE IF EXISTS `pay_to_pay`";
        $this->execute($sql);

        $sql = "CREATE PROCEDURE `pay_to_pay`(IN `from_uid` INT(11), IN `to_uid` INT(11), IN `total_sum` INT(11), OUT `_status` INT(11))
                    BEGIN
                        DECLARE from_client_id INT;
                        DECLARE to_client_id INT;
                        DECLARE from_client_amount INT;
                        SET SQL_SAFE_UPDATES = 0;
    
                        SELECT `id` INTO from_client_id FROM `clients` WHERE `uid` = from_uid;
                        SELECT `id` INTO to_client_id FROM `clients` WHERE `uid` = to_uid;
                    
                        START TRANSACTION;
                            UPDATE `wallets` SET `amount` = `amount` - total_sum WHERE `client_id` = from_client_id;
                            UPDATE `wallets` SET `amount` = `amount` + total_sum WHERE `client_id` = to_client_id;
    
                            INSERT INTO `logs` (`client_id`, `action_id`, `action_date`, `value`) VALUES(from_client_id, 2, NOW(), total_sum);
                            INSERT INTO `logs` (`client_id`, `action_id`, `action_date`, `value`) VALUES(to_client_id, 1, NOW(), total_sum);
                        COMMIT;
                        SET _status = 0;
                        SELECT _status;
                     END";

        $this->execute($sql);

        $sql = "DROP FUNCTION IF EXISTS `get_amount`";
        $this->execute($sql);

        $sql = "CREATE FUNCTION `get_amount`(client_uid INT) RETURNS int(11)
                    BEGIN
                        DECLARE client_amount INT(11) DEFAULT 0;
   
                        SELECT `amount` INTO client_amount FROM `wallets`, `clients` WHERE `clients`.`uid` = client_uid 
                        AND `clients`.`id` = `wallets`.`client_id`;

                        RETURN client_amount;
                    END;";

        $this->execute($sql);
    }
    
    public function down()
    {
        $sql = "DROP PROCEDURE `client_add`";
        $this->execute($sql);

        $sql = "DROP PROCEDURE `fill_up`";
        $this->execute($sql);

        $sql = "DROP PROCEDURE `pay_to_pay`";
        $this->execute($sql);

        $sql = "DROP FUNCTION `get_amount`";
        $this->execute($sql);
    }    
}