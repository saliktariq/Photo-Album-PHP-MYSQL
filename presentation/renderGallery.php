<?php
/*
 * Presentation layer file to generate view using the data retrieved using data access layer
 */


// Including the gallery data that is retrieved by data access layer file fetchPhotos.php
include(dirname(dirname(__FILE__)) . '/data_access/fetchPhotos.php');
//
// Rendering all available photo data in their relevant flexbox items one by one using foreach loop.
foreach ($dataArray as $key => $value) {

    // Array containing the labels from template used to generate the view
    $templateData = array(
        '{{NAME}}' => $value['title'],
        '{{ID}}' => $value['id'],
        '{{HREF}}' => 'index.php?page=large&ID=',
        '{{PAGEID}}' => $value['id'],
        '{{SOURCE}}' => absoluteToRelativePath($value['thumburl']),
        '{{ALT_TEXT}}' => $value['filename']
    );

    // Importing individual photo flex item code template
    $template = file_get_contents(dirname(dirname(__FILE__)) . '/templates/photoItem.html');

    // Display generated view
    echo parseTemplate($template, $templateData);
}


?>