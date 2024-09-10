<?php 
include("../../db/conf.php"); 
date_default_timezone_set('Asia/Manila');
if($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['file']['tmp_name'];
    $fileNameToSave = $_POST['fileNameToSave'];
    $targetPath = '../../files/';
    $targetFile = $targetPath . $fileNameToSave;

    if (move_uploaded_file($tempFile, $targetFile)) {
        echo 'Server: File uploaded successfully';
    } else {
        echo 'Failed to move file.';
    }
} else {
    echo 'Error uploading file.';
}
?>