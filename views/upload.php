<?php
include_once('templates/header.html');


$formMessage = '';
if(isset($_POST['singlefileupload'])) {
    $file = $_FILES['userfile']['name'];
    $fileHandle = processUpload($file);

    if($fileHandle['status']){
        $resizeImage = img_resize($fileHandle['filename'], $fileHandle['filename'], 600, 600, $quality=100);

        if($resizeImage['status']){
            $thumbName = $config['thumb_dir'].basename($fileHandle[2]);
            $createThumb = img_resize($fileHandle['filename'], $thumbName,150,150);

            if($createThumb['status']){
                $formMessage = $createThumb['msg'];
            }
        }
    } else {
        $formMessage = $fileHandle['msg'];
    }
}
$formTemplate = file_get_contents($config['app_dir'].'/templates/form.html');
renderForm($formTemplate,$formMessage);

include_once('templates/footer.html');
?>