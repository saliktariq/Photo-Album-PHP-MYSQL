<?php
/*
 * This file contains variables containing the SQL queries used in the application.
 * Any changes to the queries must be done here.
 */

// Query to insert photo data into database
$sql['insert_photo_data'] = "INSERT INTO `photogallery`(`filename`,`title`,`description`,`imageurl`,`thumburl`,`width`,`height`)
VALUES(:filename, :title, :description, :imageurl, :thumburl,:width,:height)";

// Query to retrieve all data. This is used to generate gallery thumbs on homepage
$sql['fetch_all'] = "SELECT * from `photogallery`";

// Query to retrieve data specific to given id. This is used for JSON service.
$sql['fetch_on_id'] = "SELECT * FROM `photogallery` WHERE (`id` = :id)";

?>