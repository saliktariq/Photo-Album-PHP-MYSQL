<?php
/*
 * Data access layer file to retrieve data from the database which is used by the presentation layer to generate view
 */


// Including sql query variable
include($config['app_dir'].'/includes/sql_queries.php');

// Creating new PDO connection object
$connection = createConnection();

// Query the database using sql statement
$dataArray = queryDB($connection,$sql['fetch_all']);

// If query fails exit with message
if ($dataArray === false){
    exit("Query failed"); // in case the query fails, exit with a message

} elseif ($dataArray == null) { // If there is no data in the database exit with a message
    exit("Database empty, no photo to display");
}


?>
