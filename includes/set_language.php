<?php
/*
 * This file updates the language of the site
 */
session_abort(); // Destroying the old session to clear session variable
session_start(); // Creating new session to set the session language

// Setting the $_SESSION['language'] global variable to user choice received using form variable $_GET['chooseLanguage']
$_SESSION['language'] = $_GET['chooseLanguage'];

// Redirecting to the homepage after language has been set.
header("Location: ../index.php");

?>