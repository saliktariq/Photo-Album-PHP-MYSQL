<?php
echo renderStaticPage($lang['site_title'], $lang['page_title'] , $lang['image_view'] );
if(!isset($_GET['ID'])){
    echo 'ID not set';
} else {
    $ID = $_GET['ID'];
    include(dirname(dirname(__FILE__)).'/presentation/renderPhoto.php');
}


include_once 'templates/footer.html';

?>