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
 * @date 02 July 2020
 */

function setLanguage($languageChoice){
    include('lang/' . htmlentities($languageChoice) . '.php');
}

/* Function to return the mime type of an uploaded file */
function getMimeType($file) {
    $file_info = new finfo(FILEINFO_MIME);  // object oriented approach!
    $mime_type = $file_info->buffer(file_get_contents($file));  // e.g. gives "image/jpeg"
    return $mime_type;
}

/* Function to process a file upload.
Takes the a single file uploaded via
the HTTP POST method */
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


function renderForm($formTemplate,$formMessage){
    require_once 'config.inc.php';
    $htmlContent = $formTemplate;
    $feedback = '<p>'.$formMessage.'</p>';
    $htmlContent = str_replace('{{FORM_FEEDBACK}}',$feedback,$htmlContent);
    return $htmlContent;
}

function addToDB($filename,$title,$description,$imageurl,$thumburl,$width,$height){

    try {
        include 'sql_queries.php';
        $connection = createConnection();
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
        $connection->commit();
        $connection = null;
        return true;
    } catch (PDOException $e) {
        $connection->rollBack();
        $connection = null;
        die($e->getMessage());
    }

}

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


//function renderHeader(){
//    include('config.inc.php');
//    include('lang/' . $config['language'] . '.php');
//    $content = '';
//    $content .= file_get_contents('templates/header.html');
//    $content = str_replace('{{TITLE}}',$lang['site_title'],$content);
//    $content = str_replace('{{PAGE_TITLE}}',$lang['page_title'],$content);
//    return $content;
//}
//
//function renderHome(){
//    include('config.inc.php');
//    include('lang/' . $config['language'] . '.php');
//    $content = renderHeader();
//    $content = str_replace('{{HEADING}}',$lang['home_heading'],$content);
//    return $content;
//}
//function renderImageView(){
//    include('config.inc.php');
//    include('lang/' . $config['language'] . '.php');
//    $content = renderHeader();
//    $content = str_replace('{{HEADING}}',$lang['image_view'],$content);
//    return $content;
//}
//
//function renderUpload(){
//    include('config.inc.php');
//    include('lang/' . $config['language'] . '.php');
//    $content = renderHeader();
//    $content = str_replace('{{HEADING}}',$lang['upload_heading'],$content);
//    return $content;
//}

function render404($message){
    return '<h1>' . $message . '</h1>';

}

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

function formValidation($array){
    $message = '';
    if($array['title'] == ''){
        $message .= 'Enter a valid title.'.PHP_EOL;
    }
    if($array['description'] == ''){
        $message .= 'Enter a valid description.'.PHP_EOL;
    }
    if(empty($_FILES['userfile']['name'])){ //source: https://stackoverflow.com/questions/2958167/how-to-test-if-a-user-has-selected-a-file-to-upload
        $message .= 'Select a valid JPEG file.'.PHP_EOL;
    }
    return $message;
}

