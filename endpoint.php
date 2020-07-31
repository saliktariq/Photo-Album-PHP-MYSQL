<?php
include ('includes/functions.php');
if (!isset($_GET['id'])) {
    echo 'Please specify an id in order to access JSON data feed'.PHP_EOL;
    echo 'Example: write \'?id=1\' after endpoint.php to access data associated with id = 1'.PHP_EOL;
} else {
    $id = $_GET['id'];
    echo json_encode(sanitizeIDData(fetchIDData($id)));
}