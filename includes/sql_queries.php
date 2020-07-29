<?php
/*
 * This file contains variables containing the SQL queries used in the application.
 * Any changes to the queries must be done here.
 */

// Query to retrieve all information about photo from database
$sql['insert_photo_data'] = "INSERT INTO `photogallery`(`filename`,`title`,`description`,`imageurl`,`thumburl`,`width`,`height`)
VALUES(:filename, :title, :description, :imageurl, :thumburl,:width,:height)";

?>