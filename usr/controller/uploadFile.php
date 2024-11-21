<?php 

include("../../db/conf.php"); 
include("../../library/ciq/compressiq.php");

date_default_timezone_set('Asia/Manila');
if($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['file']['tmp_name'];
    try {
        // Validate file exists
        if (!file_exists($tempFile)) {
            throw new Exception("Temporary file not found");
        }

        // Validate file is readable
        if (!is_readable($tempFile)) {
            throw new Exception("File is not readable");
        }

        // Validate target directory exists and is writable
        $targetDir = __DIR__ . '/../../compressedPDFFiles/';
        if (!file_exists($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                throw new Exception("Failed to create target directory");
            }
        }
        if (!is_writable($targetDir)) {
            throw new Exception("Target directory is not writable");
        }

        $compressor = new CompressIQ();
        $fileName = $_POST['fileNameToSave'];
        $compressedFilesPath = $targetDir . $fileName . '.cq';
        
        $compressedFiles = $compressor->compress($tempFile, $compressedFilesPath);
        
        if ($compressedFiles['success']) {
            echo '<script>console.log("Success uploading file. Compression ratio: ' . 
                $compressedFiles['compression_ratio'] . '%")</script>';
        } else {
            throw new Exception($compressedFiles['error'] ?? "Unknown compression error");
        }
    } catch (\Exception $e) {
        $errorMessage = "Error compressing file: " . $e->getMessage();
        error_log($errorMessage); // Log error server-side
        echo '<script>console.error("' . addslashes($errorMessage) . '")</script>';
    }

} else {
    echo 'Error uploading file.';
}
?>