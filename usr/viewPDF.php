<?php
require_once('../library/ciq/compressiq.php'); 
session_start();

// require_once '../db/conf.php';
// require_once '../pdfSign/pdfSig.php';
// if(!isset($_GET['fileName']) && !isset($_SESSION['userdetails'])) {
//     echo "Not set";
// } else {
//     $user = json_decode($_SESSION['userdetails']);
//     $fileName = $_GET['fileName'];
//     $filePath = '../files/';
//     $signaturePath = '../signatures/'. $user->usercode . '.png'; // TO DO :: change the signature name
//     if (!file_exists($signaturePath)) {
//         echo "<h3 style='color:red;position:fixed;left:20px;background:white;z-index: 1000;'>No signature upload!</h3>";
//     }
//     $signedBy = strtoupper($user->fullname);
//     $recordNo = date('mdyhis');
//     $redirectUrl = './received.php';
//     $pdfSignature = new PDFSignature($fileName, $filePath ,$signaturePath, $signedBy, $recordNo, $redirectUrl);
//     $pdfSignature->render();
// }

$basename = $_GET['filename'];
$filename = $basename . '.cq'; // Include .cq extension
$filePath = dirname(__DIR__) . '/compressedPDFFiles/';
$fullPath = $filePath . $filename;
if (!file_exists($fullPath)) {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DMS: 404 - File Not Found</title>
        <style>
            body {
                margin: 0;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                color: #333;
            }
            .error-code {
                font-size: 120px;
                font-weight: bold;
                margin: 0;
                color: #2d3436;
            }
            
            .error-message {
                font-size: 24px;
                margin: 20px 0;
            }
            
            .error-description {
                font-size: 16px;
                color: #636e72;
                text-align: center;
                max-width: 500px;
                padding: 0 20px;
            }
        </style>
    </head>
    <body>
        <h1 class="error-code">404</h1>
        <h2 class="error-message">File Not Found</h2>
        <p class="error-description">
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
        </p>
    </body>
    </html>
HTML;
    exit;
}

$decompressor = new CompressIQ();
// $compressedData = file_get_contents($filePath);
// echo $filePath . $filename;
$decompressResult = $decompressor->decompress($fullPath);
$decompressedData = $decompressResult['data'];
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename='decompressed_view.pdf'");
header("Content-Length: " . strlen($decompressedData));

echo $decompressedData;
?>