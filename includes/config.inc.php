<?php
/*
 * This file contains all the database connection settings and credentials,
 * along with configuration to change the application language.
 * PLEASE MAKE A COPY OF THIS FILE BEFORE MAKING ANY CHANGES SO THAT UNDESIRABLE CHANGES CAN BE REVERTED.
 * @author: Salik Tariq
 * @date: 02 July 2020
 */

/*
 * Database credentials to connect to MySQL database
 */
$config['db_host'] = 'mysqlsrv.dcs.bbk.ac.uk';
$config['db_name'] = 'mtariq01db';
$config['db_user'] = 'mtariq01';
$config['db_pass'] = 'bbkmysql';
$config['charset'] = 'utf8';
$config['port'] = "3306";

/*
 * Alter the following PDO DSN when database type changes from MySQL to another database.
 */
$config['dsn'] = 'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'] . ';port=' . $config['port'];

/*
 * Please refer to: https://www.php.net/manual/en/book.pdo.php for various PDO configurations
 */

$config['pdo_options'] = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
]; // learnt this at https://phpdelusions.net/pdo_examples/connect_to_mysql


/*
 * Following variable contains the current language selection, which in turn render pages in relevant language.
 */
$config['language'] = 'en';
?>
