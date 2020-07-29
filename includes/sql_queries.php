<?php
/*
 * This file contains variables containing the SQL queries used in the application.
 * Any changes to the queries must be done here.
 */

// Query to retrieve all information about photo from database
$sql['all_photo_data'] = 'select photogallary.id, photogallary.filename, photogallary.title, photogallary.description, photogallary.imageurl, photogallary.thumburl, photogallary.width, photogallary.height from photogallary order by photogallary.id ASC';


?>