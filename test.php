<?php
//$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $link;
//https://stackoverflow.com/questions/20845916/using-php-to-display-an-image-by-passing-to-html-img-tag-contains-variables-pass



include('includes/config.inc.php');
include('includes/functions.php');
include('includes/sql_queries.php');

$variable = $config['app_dir'].$config['upload_dir'];

echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $config['upload_dir']);


echo strlen('/home/mtariq01/public_www/w1fma/');