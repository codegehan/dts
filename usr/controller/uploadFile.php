<?php 

include("../../db/conf.php"); 
include("../../library/ciq/compressiq.php");

date_default_timezone_set('Asia/Manila');
if($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['file']['tmp_name'];
    try {
        $compressor = new CompressIQ();
        $fileName = $_POST['fileNameToSave'];
        $compressedFilesPath = __DIR__ . '/../../compressedPDFFiles/' . $fileName . '.cq';
        $compressedFiles = $compressor->compress($tempFile, $compressedFilesPath);
        
        if ($compressedFiles['success']) {
            echo '<script>console.log("Success uploading file. Compression ratio: ' . 
                $compressedFiles['compression_ratio'] . '%")</script>';
        } else {
            throw new Exception($compressedFiles['error']);
        }
    } catch (\Exception $e) {
        echo '<script>console.log("Error compressing file: ' . addslashes($e->getMessage()) . '")</script>';
    }
    
} else {
    echo 'Error uploading file.';
}
?>