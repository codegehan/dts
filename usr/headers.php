<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
session_start();
require dirname(__DIR__) . '/vendor/autoload.php';
use Dotenv\Dotenv;
// Create a new Dotenv instance and load the .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__)); // Specify the directory containing .env
$dotenv->load();
$baseUri = $_ENV["BASE_URI"];
$version = $_ENV["VERSION"];
// if(!defined('base_uri')) { define('base_uri', 'https://ccs-creatives.ddns.net/dts/');}
if(!defined('base_uri')) { define('base_uri', $baseUri);}
include("../db/conf.php"); 
include('../library/php/opt.php');
include("../library/php/authorizations.php");
if(!isset($_SESSION['userdetails'])){
    header("Location: " . base_uri);
} else {
    $user = json_decode($_SESSION['userdetails']);
    $officerCode = $user->usercode;
    $officeAssign = $user->office;
    $issecured = $user->issecured;
    $data = array(
        "officer" => $officerCode,
        "officeAssign" => $officeAssign
    );
    $jsonData = json_encode($data);
    $sql = "call getdashboarddetails(?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $jsonData);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $statusCount = json_decode($row['result'], true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VPRDEgital</title>
    <link rel="stylesheet" href="<?=base_uri?>includes/lineicons/web-font-files/lineicons.css">
    <link rel="stylesheet" href="<?=base_uri?>includes/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?=base_uri?>includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_uri?>includes/font/poppins.css">
    <link rel="stylesheet" href="<?=base_uri?>styles.css">
    <link rel="icon" href="<?=base_uri?>includes/img/vprde-logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="<?=base_uri?>includes/sweetalert/sweetalert.js"></script>
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar" class="expand">
            <div class="d-block px-4">
                <div class="sidebar-logo pt-2 text-center">
                    <img src="<?=base_uri?>includes/img/vprde-logo.png" style="width:80px" alt="">
                </div>
                <div class="border-bottom border-dark pb-3 text-dark text-center">
                    <span style="font-size: 12px;">The Premier University in Zamboanga del Norte</span>
                </div>
            </div>
            <input type="hidden" id="officerCode" value="<?=$officerCode?>">
            <input type="hidden" id="officerAssign" value="<?=$officeAssign?>">
            <ul class="sidebar-nav">
                <?php if (isset($issecured) && $issecured != null && $issecured != 0) { ?>
                    <li class="sidebar-item hover-effect">
                        <a href="<?=base_uri?>usr/dashboard.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-grid-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item hover-effect">
                        <a href="<?=base_uri?>usr/document.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-folder"></i>
                            <span>Document <span style="font-size:10px;" id="pendingCount"></span></span>
                        </a>
                    </li>
                    <li class="sidebar-item hover-effect">
                        <a href="<?=base_uri?>usr/track.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-search"></i>
                            <span>Track</span>
                        </a>
                    </li>
                    <li class="sidebar-item hover-effect">
                        <a href="<?=base_uri?>usr/incoming.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-inbox"></i>
                            <span>Incoming <span style="font-size:10px;" id="incomingCount"></span></span>
                        </a>
                    </li>
                    <li class="sidebar-item hover-effect">
                        <a href="<?=base_uri?>usr/received.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-check-box"></i>
                            <span>Received <span style="font-size:10px;" id="receivedCount"></span></span>
                        </a>
                    </li>
                    <li class="sidebar-item hover-effect">
                        <a href="<?=base_uri?>usr/outgoing.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-upload"></i>
                            <span>Outgoing <span style="font-size:10px;" id="outgoingCount"></span>
                        </a>
                    </li>
                    <li class="sidebar-item hover-effect">
                        <a href="<?=base_uri?>usr/completed.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-check-box"></i>
                            <span>Completed <span style="font-size:10px;" id="outgoingCount"></span>
                        </a>
                    </li>
                    <li class="sidebar-item hover-effect">
                        <a href="<?=base_uri?>usr/processeddocument.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-check-box"></i>
                            <span>Processed <span style="font-size:10px;" id="outgoingCount"></span>
                        </a>
                    </li>
                <?php }?>
                <li class="sidebar-item hover-effect">
                    <a href="<?=base_uri?>usr/password.php" rel="page" class="sidebar-link text-dark">
                        <i class="lni lni-key"></i>
                        <span>Change Password <span style="font-size:10px;" id="outgoingCount"></span>
                    </a>
                </li>
                <?php 
                    if (strtoupper($officeAssign) == "ADMINISTRATOR") { ?>
                        <li class="sidebar-item hover-effect">
                            <a href="<?=base_uri?>usr/officer.php" rel="page" class="sidebar-link text-dark">
                            <i class="lni lni-users"></i>
                                <span>Officer</span>
                            </a>
                        </li>
                <?php  }  ?>
                <li class="sidebar-item hover-effect">
                    <a href="<?=base_uri?>library/php/logout.php" rel="page" class="sidebar-link text-dark">
                        <i class="lni lni-exit"></i>
                        <span>Logout<span style="font-size:6px;" id="outgoingCount"></span>
                    </a>
                </li>
                <li class="sidebar-item" style="position:absolute;bottom:0;margin-left:12px;">
                    <!-- VERSION -->
                    <span style="font-size:14px;color:#f6d3bd;">DTS Version 1.5.0</span>
                    <!-- VERSION -->
                </li>
            </ul>
        </aside>
        <div class="main p-3" id="main-layout-control">
<?php
    if(isset($_SESSION['message']) && $_SESSION['message_code'] != '' ){
    ?>
    <script>
        setTimeout(function() {
            Swal.fire({
                title: "<?=$_SESSION['message']?>",
                icon: "<?=$_SESSION['message_code']?>",
                timer: 2000,
                showConfirmButton: false,
            });
        });
    </script>
    <?php
        unset($_SESSION['message']);
        unset($_SESSION['message_code']);
    }
?>


<script>
    function GetDashboarDetails(){
        var officerCode = $('#officerCode').val();
        var officerAssign = $('#officerAssign').val();
        $.ajax({
            url: "dashboarddetails.php",
            type: 'POST',
            data: {
                officerCode: officerCode,
                officerAssign: officerAssign
            },
            success: function(response) {
                var res = JSON.parse(response);
                var item = JSON.parse(res.result);
                Counts(item.incoming, '#incomingCount');
                Counts(item.received, '#receivedCount');
                Counts(item.pending, '#pendingCount');
                Counts(item.outgoing, '#outgoingCount');
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    $(document).ready(function() {
        GetDashboarDetails();
        setInterval(GetDashboarDetails, 5000);
    });

    function Counts(count, item){
        if(count > 0){
            $(item).text(count).addClass('bg-warning px-1');
        } else {
            $(item).text('').removeClass('bg-warning px-1');
        }
    }

    window.addEventListener('DOMContentLoaded', function() {
        const containers  = document.querySelectorAll('.container');
        containers.forEach(container => {
            container.classList.add('container-fade-in');
        });
    });
</script>
