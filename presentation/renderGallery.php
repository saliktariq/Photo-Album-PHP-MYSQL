<?php
include(dirname(dirname(__FILE__)).'/data_access/fetchPhotos.php');

foreach ($dataArray as $key => $value){
    $content = file_get_contents(dirname(dirname(__FILE__)).'/templates/photoItem.html');
    $content = str_replace('{{NAME}}',$value['filename'],$content);
    $content = str_replace('{{HREF}}','/presentation/renderPhoto.php',$content);
    $content = str_replace('{{SOURCE}}',$value['thumburl'],$content);
    $content = str_replace('{{ALT_TEXT}}',$value['filename'], $content);
    echo $content;

}
