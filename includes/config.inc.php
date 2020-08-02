<?php
/*
 * This file contains all the database connection settings and credentials,
 * along with configuration to change the application language.
 * DECLARATION: I have used most of this code from my TMA as the server environment is same.
 * PLEASE MAKE A COPY OF THIS FILE BEFORE MAKING ANY CHANGES SO THAT UNDESIRABLE CHANGES CAN BE REVERTED.
 * @author: Salik Tariq
 * @date: 01 August 2020
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

/**
 * Absolute path to application root directory (one level above current dir)
 */
$config['app_dir'] = dirname(dirname(__FILE__));

/**
 * Absolute path to directory where uploaded full size images will be stored
 * Remember: Set permission to images folder to 777
 */

//Absolute Path
$config['upload_dir'] =  $config['app_dir'].'/images/';

/*
 * Uncomment the relative path below if the application is deployed in another environment and the absolute path from root
 * can not be found. Please make sure to comment out the absolute path if relative path is uncommented.
 */
//$config['upload_dir'] =  './images/';



/**
 * Absolute path to directory where uploaded resized thumbs will be stored
 * Remember: Set permission to thumb folder to 777
 */

//Absolute Path
$config['thumb_dir'] = $config['app_dir'].'/thumb/';

/*
 * Uncomment the relative path below if the application is deployed in another environment and the absolute path from root
 * can not be found. Please make sure to comment out the absolute path if relative path is uncommented.
 */
// $config['thumb_dir'] = './thumb/';

?>
