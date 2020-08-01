<?php
/*
 * Presentation layer file to generate view using the data retrieved using data access layer
 */


// Including the photo data that is retrieved by data access layer file fetchPhotoByID.php
include(dirname(dirname(__FILE__)) . '/data_access/fetchPhotoByID.php');

// Accessing the single photo page (largephoto.html) template
$content = file_get_contents(dirname(dirname(__FILE__)) . '/templates/largephoto.html');

// Updating the template placeholders.
$content = str_replace('{{SOURCE}}', $imageURL, $content);
$content = str_replace('{{ALT_TEXT}}', $altText, $content);
$content = str_replace('{{WIDTH}}', $width, $content);
$content = str_replace('{{HEIGHT}}', $height, $content);
$content = str_replace('{{ID}}', $imageID, $content);
$content = str_replace('{{TITLE}}', $title, $content);
$content = str_replace('{{DESCRIPTION}}', $description, $content);
$content = str_replace('{{TITLE:}}', $lang['title'], $content);
$content = str_replace('{{DESCRIPTION:}}', $lang['description'], $content);

// Display generated view
echo $content;

?>
