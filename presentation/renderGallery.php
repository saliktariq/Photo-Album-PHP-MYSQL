<?php
include(dirname(dirname(__FILE__)).'/data_access/fetchPhotos.php');

foreach ($dataArray as $key => $value){
    $content = file_get_contents(dirname(dirname(__FILE__)).'/templates/photoItem.html');
    $content = str_replace('{{NAME}}',$value['title'],$content);
    $content = str_replace('{{ID}}',$value['id'],$content);
    $content = str_replace('{{HREF}}','index.php?page=large&ID=',$content);
    $content = str_replace('{{PAGEID}}',$value['id'],$content);
    $content = str_replace('{{SOURCE}}',$value['thumburl'],$content);
    $content = str_replace('{{ALT_TEXT}}',$value['filename'], $content);
    echo $content;

}
