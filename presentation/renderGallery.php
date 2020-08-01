<?php
/*
 * Presentation layer file to generate view using the data retrieved using data access layer
 */


// Including the gallery data that is retrieved by data access layer file fetchPhotos.php
include(dirname(dirname(__FILE__)).'/data_access/fetchPhotos.php');

// Rendering all available photo data in their relevant flexbox items one by one using foreach loop.
foreach ($dataArray as $key => $value){

    // Importing individual photo flex item code template
    $content = file_get_contents(dirname(dirname(__FILE__)).'/templates/photoItem.html');
    $content = str_replace('{{NAME}}',$value['title'],$content);
    $content = str_replace('{{ID}}',$value['id'],$content);
    $content = str_replace('{{HREF}}','index.php?page=large&ID=',$content);
    $content = str_replace('{{PAGEID}}',$value['id'],$content);
    $content = str_replace('{{SOURCE}}',$value['thumburl'],$content);
    $content = str_replace('{{ALT_TEXT}}',$value['filename'], $content);
    echo $content;

}
?>