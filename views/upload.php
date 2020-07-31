<?php
include('includes/config.inc.php');
echo renderUpload();


$formMessage = '';
if(isset($_POST['singlefileupload'])) {
    $fileHandle = processUpload($_FILES['userfile']);

    if($fileHandle['status']){
        $resizeImage = img_resize($fileHandle['filename'], $fileHandle['filename'], 600, 600, $quality=100);

        if($resizeImage['status']){
            $thumbName = $config['thumb_dir']. 'thumb' . basename($fileHandle['filename']);
            $createThumb = img_resize($fileHandle['filename'], $thumbName,150,150);

            if($createThumb['status']){
                $dbTransaction = addToDB(basename($fileHandle['filename']),htmlentities($_POST['title']),htmlentities($_POST['description']),$fileHandle['filename'],$thumbName,$resizeImage['newWidth'],$resizeImage['newHeight']);
                $formMessage = $createThumb['msg'];
                if(!$dbTransaction){
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
$formTemplate = file_get_contents($config['app_dir'].'/templates/form.html');
echo renderForm($formTemplate,$formMessage);

include_once('templates/footer.html');
?>