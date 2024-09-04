<?php 
include("../../db/conf.php"); 
session_start();
$spname = $_POST["spname"];
$data = $_POST["jsonData"];
$sql = "call ".$spname."(?)";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $data);

if($stmt->execute()){
    $result = $stmt->get_result();
    $response = $result->fetch_assoc();
    echo json_encode($response);
}
?>