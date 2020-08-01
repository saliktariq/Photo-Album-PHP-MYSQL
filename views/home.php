<?php

//echo renderHome();
echo renderStaticPage($lang['site_title'], $lang['page_title'] , $lang['home_heading'] );

include(dirname(dirname(__FILE__)).'/presentation/renderGallery.php');

include_once 'templates/footer.html';

?>