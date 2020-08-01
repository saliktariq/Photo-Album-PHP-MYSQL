<?php
/**
 * This file processes the uploads.
 */


/**
 * Generating static HTML using funciton renderStaticPage(). The three arguments correspond to
 * the website Title, page top title and the h1 heading on the page.
 */
echo renderStaticPage($lang['site_title'], $lang['page_title'], $lang['upload_heading']);

// $formMessage contains the user feedback that is provided to the user with regard to the form submission
$formMessage = '';

// Checking if the request was made using the form submit button
if (isset($_POST['singlefileupload'])) {

    // function formValidation($array) checks if the form is filled and no field is left empty
    $formMessage = formValidation($_POST);

    if ($formMessage != '') { //if there is any error message show them to the user
        $formMessage;
    } else {
        $fileHandle = processUpload($_FILES['userfile']); // processUpload($file) handles the actual uploading

        if ($fileHandle['status']) { // if the upload is successful with 'status' == true then carry on processing

            //resizes the uploaded temporary file with maximum dimension of 600px.
            $resizeImage = img_resize($fileHandle['filename'], $fileHandle['filename'], 600, 600, $quality = 100);

            //if resize has been successful, carry on processing further
            if ($resizeImage['status']) {

                //updating file name to add prefix 'thumb' for the thumbnail
                $thumbName = $config['thumb_dir'] . 'thumb' . basename($fileHandle['filename']);

                //generate thumbnail with maximum dimension of 150px
                $createThumb = img_resize($fileHandle['filename'], $thumbName, 150, 150);

                //if thumbnail is generated successfully, carry on adding the data to database
                if ($createThumb['status']) {


                    $dbTransaction = addToDB(basename($fileHandle['filename']), htmlentities($_POST['title']), htmlentities($_POST['description']), $fileHandle['filename'], $thumbName, $resizeImage['newWidth'], $resizeImage['newHeight']);

                    //Gather relevant user form feedback.
                    $formMessage = $createThumb['msg'];

                    //if DB transaction fails, rollback by deleting the uploaded file AND thumbnail to keep application integrity.
                    if (!$dbTransaction) {
                        unlink($fileHandle['filename']);
                        unlink($thumbName);
                        $formMessage = "DB transaction unsuccessful, deleted file and thumbnail.";

                    }
                }
            }
        } else {
            $formMessage = $fileHandle['msg'];
        }
    }

}

//renders the form to display to user
$formTemplate = file_get_contents($config['app_dir'] . '/templates/form.html');
echo renderForm($formTemplate, $formMessage);

// renders footer html
include_once('templates/footer.html');
?>