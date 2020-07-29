<?php
include_once('includes/page_top.php');
// rendering the heading and description of the page using renderStaticPage function from functions.php
$content = renderStaticPage($lang['error_heading'], $lang['error_description'], $content);
echo $content;
include_once('templates/footer.html');
?>