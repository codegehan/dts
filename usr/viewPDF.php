<?php 
session_start();
require_once '../db/conf.php';
require_once '../pdfSign/pdfSig.php';
if(!isset($_GET['fileName']) && !isset($_SESSION['userdetails'])) {
    echo "Not set";
} else {
    $user = json_decode($_SESSION['userdetails']);
    $fileName = $_GET['fileName'];
    $filePath = '../files/';
    $signaturePath = '../signatures/'. $user->usercode . '.png'; // TO DO :: change the signature name
    $signedBy = strtoupper($user->fullname);
    $recordNo = date('mdyhis');
    $redirectUrl = './received.php';
    $pdfSignature = new PDFSignature($fileName, $filePath ,$signaturePath, $signedBy, $recordNo, $redirectUrl);
    $pdfSignature->render();
}
?>