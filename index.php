<?php

/*
 * This page is the only point of entry into the application
 */

//implementing locale using sessions to remember the choice
session_start();


// importing required php files
require_once('includes/functions.php');
require_once('includes/sql_queries.php');
require_once('includes/config.inc.php');

// Checking if Session variable is set for custom language selection
if(isset($_SESSION['language'])){
    require('lang/' . $_SESSION['language'] . '.php');
} else{
    // Load default language if session variable is not set
    require('lang/' . $config['language'] . '.php');
}


// Loading the MyAutoloader function
spl_autoload_register('MyAutoloader');

// checking if $_GET variable is set, push result into $id variable that would decide which page to display
if (!isset($_GET['page'])) {
    $id = 'home';
} else {
    $id = $_GET['page'];
}

// switch statement to choose which page must be displayed
switch ($id) {
    case 'home':
        include 'views/home.php';
        break;

    case 'artists':
        include 'views/artists.php';
        break;

    case 'songs':
        include 'views/songs.php';
        break;

    default:
        include 'views/404.php';
}
?>
