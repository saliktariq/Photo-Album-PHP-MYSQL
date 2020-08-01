<?php
/**
 * This is the home view. This is the default page that loads upon visiting the application url.
 */

/**
 * Generating static HTML using funciton renderStaticPage(). The three arguments correspond to
 * the website Title, page top title and the h1 heading on the page.
 */
echo renderStaticPage($lang['site_title'], $lang['page_title'], $lang['home_heading']);

//including the renderGallery.php page to render the gallery data to home.
include(dirname(dirname(__FILE__)) . '/presentation/renderGallery.php');

//rendering the footer data
include_once 'templates/footer.html';

?>