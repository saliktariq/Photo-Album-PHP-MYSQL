<?php

echo renderStaticPage($lang['site_title'], $lang['page_title'] , $lang['error_heading'] );
echo render404($lang['error_description']);
include_once 'templates/footer.html';

?>