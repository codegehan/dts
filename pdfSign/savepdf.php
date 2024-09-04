<?php
// Enable error reporting for debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require_once '../db/conf.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '../files/';
    // Ensure the upload directory exists and is writable
    if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
        echo 'Error: Upload directory does not exist or is not writable.';
        exit;
    }
    // Check if the file is uploaded correctly
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_POST["fileName"]; // Retrieve the file name from POST data
        // Sanitize file name to prevent directory traversal attacks
        $fileName = basename($fileName);
        // Validate file type (for example, allow only PDF files)
        $fileType = mime_content_type($_FILES['file']['tmp_name']);
        if ($fileType !== 'application/pdf') {
            echo 'Error: Only PDF files are allowed.';
            exit;
        }
        // Save the file to the server
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName)) {
            $recNo = $_POST["recordNo"];
            $jsonData = json_encode(array("signcode" => $recNo));
            $sql = "call signrecord(?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $jsonData);
            $stmt->execute();
            echo 'File saved successfully.';
        } else {
            echo 'Failed to save file. Error code: ' . $_FILES['file']['error'];
        }
    } else {
        echo 'Error: File upload failed or no file uploaded.';
    }
} else {
    echo 'Invalid request.';
}
?>