<?php
/*
 * Data access layer file to retrieve data from the database which is used by the presentation layer to generate view
 * This file retrieves data specific to an ID.
 */

// Using fetchIDData($id) function to query database
$imagedata = fetchIDData($ID);

/*
 * Populating variables with the data retrieved from the database. The retrieved data is an associative array
 * with single record associated with the $ID provided. Hence data is accessed from two dimensional array.
 */
$imageURL = absoluteToRelativePath($imagedata[0]['imageurl']);
$altText = $imagedata[0]['filename'];
$width = $imagedata[0]['width'];
$height = $imagedata[0]['height'];
$imageID = $imagedata[0]['id'];
$title = $imagedata[0]['title'];
$description = $imagedata[0]['description'];

?>

