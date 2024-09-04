<?php 
include("../../db/conf.php"); 
session_start();
$spname = $_POST["spname"];
$jsonData = $_POST["jsonData"];
$sql = "call ".$spname."(?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $jsonData);
if($stmt->execute()){
    $result = $stmt->get_result();
    $response = $result->fetch_assoc();
    
    if($spname == "changepassword") {
        if (isset($_SESSION["userdetails"]) && $response["statuscode"] == 1) {
            $userdetails = json_decode($_SESSION['userdetails'], true);
            $userdetails['issecured'] = 1;
            $_SESSION['userdetails'] = json_encode($userdetails);
        }
    }
    echo json_encode($response);
}
$stmt->close();
$con->close();
?>