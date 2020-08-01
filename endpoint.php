<?php
/**
 * This file provides access to JSON stream. In order to access the data, an id with number must be provided.
 * For example: in order to retrieve data associated with ID:4 ?id=4 must be written after endpoint.php URL.
 * All data retrieved is in JSON format.
 */

//including functions file to access relevant functions
include('includes/functions.php');

//checking if the user has put in the json request in the URL
if (!isset($_GET['id'])) {
    echo 'Please specify an id in order to access JSON data feed' . PHP_EOL;
    echo 'Example: write \'?id=1\' after endpoint.php to access data associated with id = 1' . PHP_EOL;
} else {
    $id = $_GET['id'];
//accessing data from database, sanitising the data and converting the associative array to JSON format before echoing
    echo json_encode(sanitizeIDData(fetchIDData($id)));
}

?>