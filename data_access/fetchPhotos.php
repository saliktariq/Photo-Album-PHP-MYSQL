<?php
include(dirname(dirname(__FILE__)).'/includes/config.inc.php');
include($config['app_dir'].'/includes/functions.php');
include($config['app_dir'].'/includes/sql_queries.php');


$connection = createConnection();
$dataArray = queryDB($connection,$sql['fetch_all']);
if ($dataArray === false){
    exit("Query failed"); // in case the query fails, exit with a message
} elseif ($dataArray == null) {
    exit("Database empty, no photo to display");
}



