<?php
/*
 * This file contains all the functions that help to make the code precise.
 * @author: Salik Tariq
 * @date: 29 July 2020
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
 * @date: 29 July 2020
 */
function createConnection()
{
    include(dirname(dirname(__FILE__)).'/includes/config.inc.php');
    include($config['app_dir'].'/classes/MyPDO.php');
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
 * @date 29 July 2020
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
 * Function to set preferred language of the Application
 * @param $languageChoice String containing target language choice
 * @return include string to return relevant language file
 * @author Salik Tariq
 * @date 29 July 2020
 */

function setLanguage($languageChoice){
    include('lang/' . htmlentities($languageChoice) . '.php');
}

/* Function to return the mime type of an uploaded file
 * @author Ian Hollender
 * Code reused from HOE
 */
function getMimeType($file) {
    $file_info = new finfo(FILEINFO_MIME);  // object oriented approach!
    $mime_type = $file_info->buffer(file_get_contents($file));  // e.g. gives "image/jpeg"
    return $mime_type;
}

/* Function to process a file upload. Takes the a single file uploaded via the HTTP POST method
 * @author Ian Hollender
 * Code reused from HOE with slight modifications
*/
function processUpload($file)
{
    include 'config.inc.php';


        // Get the error code
        $error = $file['error'];
        $errorResponse = '';

        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            if ($error == UPLOAD_ERR_OK) {
                // Get the mime type
                $mime_type = getMimeType($_FILES['userfile']['tmp_name']);
                if (strpos($mime_type, "image/jpeg") !== false and ((substr($_FILES['userfile']['name'] , -4) == ".jpg") or (substr($_FILES['userfile']['name'] , -5) == ".jpeg") )) {
                    //
                    $upfilename = 'x'. basename($file['name']);
                    $newname = $config['upload_dir'] . $upfilename;
                    // Check file doesn't already exist
                    if (file_exists($newname)) {
                        $errorResponse = "The file $upfilename already exists!";
                    } else {
                        $tmpname = $file['tmp_name'];


                        if (move_uploaded_file($tmpname, $newname)) {
                            $errorResponse = 'File successfully uploaded';
                            $result['status'] = true;
                            $result['msg'] = $errorResponse;
                            $result['filename'] = $newname;

                            return $result;
                        } else {
                            $errorResponse = 'File upload failed';
                        }
                    }
                } else {
                    $errorResponse = 'File type not permitted. Please upload a valid JPEG file.';
                }
            } else if ($error == UPLOAD_ERR_NO_FILE) {
                $errorResponse = 'No file selected.';
            } else if ($error == UPLOAD_ERR_INI_SIZE) {
                $errorResponse = 'Maximum file size exceeded.';
            } else {
                $errorResponse = 'Oops. Something went wrong.';
            }
        }
        $result['status'] = false;
        $result['msg'] = $errorResponse;
        return $result;
    }



/**
 * Resize images
 *
 * Function to resize images to fit area specified when called
 *
 * @param string $in_img_file Input image file
 * @param string $out_img_file Output image filename
 * @param int $req_width Width of area the image should fill
 * @param int $req_height Height of area the image should fill
 * @return bool, message, new_width, new_height, origWidth, origHeight as array
 * @author Ian Hollender
 * Code reused from the HOE
 */
function img_resize($in_img_file, $out_img_file, $req_width, $req_height, $quality=100) {

    // Get image file details
    $details = getimagesize($in_img_file);
    if ($details) {
        // get file details
        $width = $details[0];
        $height = $details[1];
        $type = $details[2];
        $htmlWH = $details[3];
        // Check image type and use correct imagecreatefrom* function
        // Allow only jpeg files
        switch ($type) {
            case IMAGETYPE_JPEG:
                $src = @imagecreatefromjpeg($in_img_file);
                break;

            default:
                $result['status'] = false;
                $result['msg'] = "Image is not a jpeg.";
                return $result;
        }

        // Check if image is smaller (in both directions) than required image
        if ($width < $req_width and $height < $req_height) {
            // Use original image dimensions
            $new_width = $width;
            $new_height = $height;
        } else {
            // Otherwise, Test orientation of image and set new dimensions appropriately
            // i.e. calculate the scale factor by dividing the required dimension by the original dimension
            if ($width > $height) {
                // landscape
                $scaleFactor = $req_width / $width;
            } else {
                // portrait
                $scaleFactor = $req_height / $height;
            }
            $new_width = round($width * $scaleFactor);
            $new_height = round($height * $scaleFactor);
        }

        // Create the new canvas ready for resampled image to be inserted into it
        $newCanvas = imagecreatetruecolor($new_width, $new_height);
        // Resample input image into newly created image - use imagecopyresampled()
        imagecopyresampled($newCanvas, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        // Create output jpeg at quality level of N - last parameter in function call
        imagejpeg($newCanvas, $out_img_file, $quality);

        // Destroy intermediate image files in memory
        imagedestroy($src);
        imagedestroy($newCanvas);
        // Return image data indicating success
        $array["status"]=true;
        $array["msg"]="File uploaded successfully";
        $array["newWidth"]=$new_width;
        $array["newHeight"]=$new_height;
        $array["origWidth"]=$width;
        $array["origHeight"]=$height;
        return $array;

    } else {
        // Return data indicating failure
        $array["status"]=false;
        $array["msg"]="$in_img_file is not an image file";
        return $array;
    }
}

/**
 * @param $formTemplate Form template data
 * @param $formMessage Feedback message to the user
 * @return string containing HTML code to render form.
 * @author Salik Tariq
 * @date 01 August 2020
 */
function renderForm($formTemplate,$formMessage){
    require_once 'config.inc.php';
    $htmlContent = $formTemplate;
    $feedback = '<p>'.$formMessage.'</p>';
    $htmlContent = str_replace('{{FORM_FEEDBACK}}',$feedback,$htmlContent);
    return $htmlContent;
}

/**
 * @param $filename contains the file name of the file being uploaded
 * @param $title contains the title of the filename as input on the form
 * @param $description the description of the filename as input on the form
 * @param $imageurl contains the image url of the full size image (resized at 600px max)
 * @param $thumburl the image url of the thumbnail image (resized at 150px max)
 * @param $width width of the full size image
 * @param $height height of the full size image
 * @return bool true if transaction completes without error
 * @author Salik Tariq
 * @date 01 August 2020
 */
function addToDB($filename,$title,$description,$imageurl,$thumburl,$width,$height){

    try {
        include 'sql_queries.php';
        $connection = createConnection();

        // Creating sql transaction to keep database integrity
        $connection->beginTransaction();
        $query = $sql['insert_photo_data'];
        $addToDb = $connection->prepare($query);
        $addToDb->bindParam(":filename", $filename);
        $addToDb->bindParam(":title", $title);
        $addToDb->bindParam(":description", $description);
        $addToDb->bindParam(":imageurl", $imageurl);
        $addToDb->bindParam(":thumburl", $thumburl);
        $addToDb->bindParam(":width", $width);
        $addToDb->bindParam(":height", $height);

        $result = $addToDb->execute();
        // commit all changes to database if everything has completed without error
        $connection->commit();

        // destroy connection variable
        $connection = null;
        return true;
    } catch (PDOException $e) {
        // rollback any changes if the transaction has been interrupted.
        $connection->rollBack();
        $connection = null;

        // exit with message if there has been an error
        die($e->getMessage());
    }

}

/**
 * @param $id contains the id that is being interrogated.
 * @return array containing data relevant to the $id provided
 * @author Salik Tariq
 * @date 01 August 2020
 */
function fetchIDData($id){
    try {
        include('sql_queries.php');
        $connection = createConnection();
        $query = $sql['fetch_on_id'];
        $data = $connection->prepare($query);
        $data->bindParam(":id",$id);
        $result = $data->execute();
        $result = array();    //source: https://stackoverflow.com/questions/26151048/loop-through-the-data-in-pdo
        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        $connection = null;
        return $result;
    } catch (PDOException $e){
        $connection = null;
        die($e->getMessage());
    }



}

/**
 * @param $siteTitle containing the site title in the header.
 * @param $pageTitle containing the main titile of the page
 * @param $heading containing the h1 heading for the page
 * @return string containing generated html code from the template
 * @author Salik Tariq
 * @date 01 August 2020
 */
function renderStaticPage($siteTitle, $pageTitle, $heading){

        $templateData = array(
            "{{TITLE}}" => $siteTitle,
            "{{PAGE_TITLE}}" => $pageTitle,
            "{{HEADING}}" => $heading
        );
        $htmlContent = file_get_contents('templates/header.html');
        $htmlContent = parseTemplate($htmlContent,$templateData);
        return $htmlContent;

}

/**
 * @param $message containing the message to be rendered
 * @return string containing the h1 heading message
 * @author Salik Tariq
 * @date 01 August 2020
 * This function helps separate html from php code on 404.php page
 */
function render404($message){
    return '<h1>' . $message . '</h1>';

}

/**
 * This helper function generates an array containing all the values that are stored in the db
 * @return array  an array of data relevant to the photo.
 * @author Salik Tariq
 * @date 01 August 2020
 */
function galleryDataArray(){
    $photoData = array();
    $photoData['id'] = '';
    $photoData['filename'] = '';
    $photoData['title'] = '';
    $photoData['description'] = '';
    $photoData['imageurl'] = '';
    $photoData['thumburl'] = '';
    $photoData['width'] = '';
    $photoData['height'] = '';
    return $photoData;
}

/**
 * @param $idArray an associative array containing data from the database
 * @return array containing sanitized data from the database
 * @author Salik Tariq
 * @date 01 August 2020
 */
function sanitizeIDData($idArray){
    foreach ($idArray as $key => $value){
        $photoData = galleryDataArray();
        $photoData['id'] = htmlentities($value['id']);
        $photoData['filename'] = htmlentities($value['filename']);
        $photoData['title'] = htmlentities($value['title']);
        $photoData['description'] = htmlentities($value['description']);
        $photoData['imageurl'] = htmlentities($value['imageurl']);
        $photoData['thumburl'] = htmlentities($value['thumburl']);
        $photoData['width'] = htmlentities($value['width']);
        $photoData['height'] = htmlentities($value['height']);

    }
    return $photoData;

}

/**
 * @param $array the $_POST[] global variable containing all submitted form data
 * @return string message containing any errors accumulated after validating the form
 * @author Salik Tariq
 * @date 01 August 2020
 */

function formValidation($array){
    $message = '';
    if($array['title'] == ''){
        $message .= 'Enter a valid title.'.PHP_EOL;
    }
    if($array['description'] == ''){
        $message .= 'Enter a valid description.'.PHP_EOL;
    }
    if(strlen($array['description']) > 254) {
        $message .= 'Maximum description length is 254 characters.'.PHP_EOL;
    }
    if(empty($_FILES['userfile']['name'])){ //source: https://stackoverflow.com/questions/2958167/how-to-test-if-a-user-has-selected-a-file-to-upload
        $message .= 'Select a valid JPEG file.'.PHP_EOL;
    }
    return $message;
}

