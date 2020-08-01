<?php
/**
 * This page generates the 404 page if a page is requested that was not part of the application.
 */


/**
 * Generating static HTML using funciton renderStaticPage(). The three arguments correspond to
 * the website Title, page top title and the h1 error heading on the page.
 */
echo renderStaticPage($lang['site_title'], $lang['page_title'] , $lang['error_heading'] );


// renders the h1 error message stored in language file.
echo render404($lang['error_description']);

// rendering the footer section
include_once 'templates/footer.html';

?>