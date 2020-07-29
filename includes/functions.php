<?php
/*
 * This file contains all the functions that help to make the code precise.
 * @author: Salik Tariq
 * @date: 02 July 2020
 */


/*
 * parseTemplate: populate html template with actual data creating dynamic content during execution
 * @param $template String containing html template
 * @param $templateData Array containing key value pairs of html placeholder and actual data to populate
 * @return variable $template containing populated template html in form of string
 * @author Mr Ian Hollender
 * @source Course slides / HOE
 */

function parseTemplate($template, $templateData) //source: Mr Ian Hollender HOE:7/8
{
    foreach ($templateData as $key => $value) {
        $template = str_replace($key, $value, $template);
    }
    return $template;
}

/*
 * Function to convert seconds in the form of mm:ss
 * @param $time containing time in seconds
 * @return time in format of mm:ss
 * @author: Salik Tariq
 * @date 02 July 2020
 */

function songLengthToMinSec($time)
{
    $result = date('i:s', $time);
    return $result;
}

/*
 * Function to autoload classes in php file
 * @author Ian Hollender
 * @source Course slides / HOE
 */
function myAutoloader($class)
{
    require('classes/' . $class . '.php');
}

/*
 * Creates a PDO database object
 * @return active PDO database connection
 * @author: Salik Tariq
 * @date: 02 July 2020
 */
function createConnection()
{
    include('config.inc.php'); // included to access config[] variables inside the function block
    require_once('classes/MyPDO.php'); // included to create MyPDO object
    try {
        $connection = new MyPDO($config['dsn'], $config['db_user'], $config['db_pass'], $config['pdo_options']);
    } catch (PDOException $e) {
        $connection = null;
        die($e->getMessage());
    }
    return $connection;
}

/*
 * Queries the database PROVIDED an active MyPDO connection is in place
 * Run this query AFTER creating database PDO Object (connection)
 * @return associative array containing database query result
 * @author Salik Tariq
 * @date 02 July 2020
 */
function queryDB($link, $sql)
{
    $dataQ = $link->prepare($sql);
    $dataQ->execute();
    $result = array();    //source: https://stackoverflow.com/questions/26151048/loop-through-the-data-in-pdo
    while ($row = $dataQ->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }
    $dataQ = null;
    return $result;
}

/*
 * Function to avoid repetition of code used to render page headings, description and parsing template
 * @param $heading containing page heading in form of String
 * @param $description containing page description in the form of String
 * @$htmlContent String containing html that needs rendered data to be concatenated to it.
 * @return $htmlContent containing String of html containing required page render
 * @author Salik Tariq
 * @date 02 July 2020
 */

function renderStaticPage($heading, $description, $htmlContent)
{
    $templateData = array(
        "{{HEADING}}" => $heading,
        "{{CONTENT}}" => $description
    );
    $htmlContent .= file_get_contents('templates/page.html');
    $htmlContent = parseTemplate($htmlContent, $templateData);
    return $htmlContent;
}

/*
 * Function to set preferred language of the Application
 * @param $languageChoice String containing target language choice
 * @return include string to return relevant language file
 * @author Salik Tariq
 * @date 02 July 2020
 */

function setLanguage($languageChoice){
    include('lang/' . htmlentities($languageChoice) . '.php');
}
?>