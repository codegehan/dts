<?php 
session_start();
if(isset($_SESSION['userdetails'])) {
    if(isset($_POST['employeeCode']) && isset($_FILES['signature']) && isset($_POST['path'])) {
        $empCode = $_POST['employeeCode'];
        $file = $_FILES['signature'];
        $uploadDir = $_POST['path']; // Directory passed from the client
        // Ensure the directory exists and has correct permissions
        if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
            echo "Upload directory is invalid or not writable.";
            exit;
        }
        // Create the file path, ensuring a safe filename
        $uploadFilePath = $uploadDir . basename($empCode . '.png');

        // Move the uploaded file to the designated directory
        if(move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
            echo "File uploaded successfully for employee: " . $empCode;
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "No file, employee code, or path provided.";
    }
} else {
    echo "Session not started.";
}
