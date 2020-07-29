<?php
/*
 * contains all the static text found within the app.
 * Any text displayed in the application can be altered by changing the relevant $lang[] array variable.
 */

// Application heading
$lang['page_title'] = 'W1 Music';

// Text to display total active artists and total songs
$lang['total_active_artists'] = 'Total Active Artists: ';
$lang['total_songs'] = ' Total Songs: ';

/*
 * Text entries for the home page
 */

$lang['main_heading'] = 'Welcome to the Home Page';
$lang['home_description'] = 'This is the home page for W1 Music App that retrieves data about various artists and their songs. The data is stored securely in MySQL server. Data retrieval is made possible through PHP programming language.';

/*
 * Text entries for artists page
 */
$lang['artist_name'] = 'Artist Name';
$lang['no_of_songs'] = 'Number of Songs';
$lang['artist_heading'] = 'Welcome to Artist Page';
$lang['artist_description'] = ''; // keeping this entry for consistency of style and if requirements change in future to add a description

/*
 * Text entries for songs page
 */

$lang['song_title'] = 'Song Title';
$lang['song_duration'] = 'Song Duration';
$lang['song_heading'] = 'Welcome to the Songs Page';
$lang['song_description'] = ''; // keeping this entry for consistency of style and if requirements change in future to add a description

/*
 * Text entries for error page
 */

$lang['error_heading'] = 'Page Not Found';
$lang['error_description'] = 'Oh No! We can not find what you are looking for. ';
?>