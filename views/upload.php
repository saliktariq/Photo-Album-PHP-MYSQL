<?php
include_once('includes/page_top.php');
// rendering the heading and description of the page using renderStaticPage function from functions.php
$content = renderStaticPage($lang['main_heading'], $lang['home_description'], $content);
// PHP echos the result of renderStaticPage to the browser
echo $content;
include_once('templates/footer.html');
?>