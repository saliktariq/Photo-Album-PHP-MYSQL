<?php
/*
 * Presentation layer file to generate view using the data retrieved using data access layer
 */


// Including the photo data that is retrieved by data access layer file fetchPhotoByID.php
include(dirname(dirname(__FILE__)) . '/data_access/fetchPhotoByID.php');

// Array containing the labels from template used to generate the view
$templateData = array(
    '{{SOURCE}}' => $imageURL,
    '{{ALT_TEXT}}' => $altText,
    '{{WIDTH}}' => $width,
    '{{HEIGHT}}' => $height,
    '{{ID}}' => $imageID,
    '{{TITLE}}' => $title,
    '{{DESCRIPTION}}' => $description,
    '{{TITLE:}}' => $lang['title'],
    '{{DESCRIPTION:}}' => $lang['description'],
    '{{WIDTH:}}' => $lang['width'],
    '{{HEIGHT:}}' => $lang['height']
);

// Accessing the single photo page (largephoto.html) template
$template = file_get_contents(dirname(dirname(__FILE__)) . '/templates/largephoto.html');

// Display generated view
echo parseTemplate($template,$templateData);

?>
