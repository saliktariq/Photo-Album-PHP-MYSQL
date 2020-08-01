<?php
/**
 * This file generates code for the larger image, which can be accessed by clicking thumbnail image.
 */

/**
 * Generating static HTML using funciton renderStaticPage(). The three arguments correspond to
 * the website Title, page top title and the h1 heading on the page.
 */
echo renderStaticPage($lang['site_title'], $lang['page_title'], $lang['image_view']);

/**
 * Following code checks if global variable $_GET['ID'] is set. This variable will be required to access
 * the relevant image file in full size view. If $_GET['ID'] is set, it is then assigned to variable $ID
 */
if (!isset($_GET['ID'])) {
    echo 'ID not set';
} else {
    $ID = $_GET['ID'];

    // The variable $ID is forwarded to / used by the presentation layer file renderPhoto.php to render relevant image file
    include(dirname(dirname(__FILE__)) . '/presentation/renderPhoto.php');
}

// renders the footer html
include_once 'templates/footer.html';

?>