<?php 
include("../../db/conf.php"); 
date_default_timezone_set('Asia/Manila');
if($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['file']['tmp_name'];
    $originalFileName = $_FILES['file']['name'];
    $fileTransactionCode = $_POST['transactioncode'];
    $newFileName = $fileTransactionCode . '-' . $originalFileName; 

    $targetPath = '../../files/';
    $targetFile = $targetPath . $newFileName;

    if (move_uploaded_file($tempFile, $targetFile)) {
        $data = array(
            'transactioncode' => $fileTransactionCode,
            'filename' => $newFileName 
        );
        $jsonString = json_encode($data);
        $sql = "call setfilename(?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $jsonString);
        if ($stmt->execute()) {
            echo 'Server: File uploaded successfully as: ' . $newFileName . ' ' . json_encode($data);
        } else {
            echo 'Error updating file name';
        }
        $stmt->execute();
        $stmt->close();
        $con->close();
        
    } else {
        echo 'Failed to move file.';
    }
} else {
    echo 'Error uploading file.';
}
?>