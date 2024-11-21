<?php 
    include_once("db/conf.php"); 
    session_start();
    if(isset($_POST['LoginUser'])){
        $data = array(
            "email" => $_POST['email'],
            "password" => $_POST['password']
        );
        $jsonData = json_encode($data);
        $sql = "call login(?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $jsonData);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($row['statuscode'] == 0){
            $_SESSION['message'] = $row['result'];
            $_SESSION['message_code'] = 'error';
        } elseif($row['statuscode'] == 1){
            $_SESSION['userdetails'] = $row['result'];
            $user = json_decode($row['result']);
            if($user->issecured == 0) {
                header('Location: usr/password.php');
            } else {
                header('Location: usr/dashboard.php');
            }
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VPRDE DMS</title>
    <link rel="stylesheet" href="includes/lineicons/web-font-files/lineicons.css">
    <link rel="stylesheet" href="includes/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/font/poppins.css">
    <link rel="icon" href="includes/img/vprde-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <script src="includes/sweetalert/sweetalert.js"></script>
</head>
<style>
.main-container {
    background: url("includes/img/vprde-bg.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}
#loginBtn{
    position: absolute;
    top: 90%;
    left: 95%;
    transform: translate(-90%, -95%);
    min-width: 150px;
    min-height: 50px;
    border-radius: 0;
    transition: all 0.3s ease-in-out;
}
#loginBtn:hover{
    transform: translate(-90%, -95%) scale(1.1); 
}
#loginUser{
    background:linear-gradient(to right, #ff9966, #ff5e62);
    border-radius:0px;
    transition: all 0.3s ease-in-out;
}
#loginUser:hover{
    transform: scale(1.05)
}
</style>
<body>
    <nav class="navbar navbar-light bg-light w-100" style="position: fixed; background: linear-gradient(to right, #ff9966, #ff5e62);">
        <div class="ps-3 pt-2 d-flex">
            <h5 style="font-size: 1.5rem; text-shadow: 2px 2px 4px #000000; color: #fff;">VPRDE Document Management System</h5>
        </div>
    </nav>
    <div class="wrapper">
        <div class="main p-3 main-container">
        <form id="loginForm" method="POST">
            <div class="bg-light w-25 p-3 login-container rounded shadow" id="loginContainer">
                <div class="my-3 text-center">
                    <h5 style="text-shadow: 2px 2px 4px #ccc;color:#000000">Authorization</h5>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" class="form-control" placeholder="Enter email" id="email" name="email" autocomplete="off" required></input>
                    <label for="email" class="ms-2" style="font-size:12px;">Email</label>
                </div>
                <div class="form-floating mb-2 position-relative">
                    <input type="password" class="form-control" placeholder="Enter password" id="password" name="password" autocomplete="off" maxlength="12" required></input>
                    <label for="password" class="ms-2" style="font-size:12px;">Password</label>
                    <button class="btn btn-link position-absolute top-50 end-0 translate-middle-y pe-3" type="button" onclick="togglePasswordVisibility()" style="border: none;">
                        <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                    </button>
                </div>
                <div class="text-center">
                    <button type="submit" name="LoginUser" class="btn btn-sm px-3 mt-2 w-75" style="background: linear-gradient(to right, #ff9966, #ff5e62);">Login</button>
                </div>
                <div class="text-center mt-2">
                    <span style="font-size:10px;"><i>DON'T HAVE ACCOUNT YET? PLEASE CONTACT ADMINISTRATOR</i></span>
                </div>
            </div>
        </form>
        </div>
    </div>
    <div>
        <button type="button" class="btn btn-danger bg-gradient" id="loginBtn" onclick="ShowLoginContainer()">LOGIN</button>
    </div>
</body>
<footer class="navbar navbar-light bg-light w-100 fixed-bottom" style="background:linear-gradient(to right, #ff9966, #ff5e62);max-height:40px;">
    <div class="w-100 text-center">
        <!-- <h5 style="font-size:1rem;text-shadow: 2px 2px 4px #000000;color:#fff;">VPRDEgital Record Tracking and Archiving Management System</h5> -->
        <small style="color: #fff;">&copy; 2024 VPRDEgital DMS. All rights reserved.</small>
    </div>
</footer>
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
    document.addEventListener('DOMContentLoaded', function() {
        ShowLoginContainer();
    });
    function ShowLoginContainer(){
        var loginContainer = document.getElementById('loginContainer');
        loginContainer.classList.toggle('show-container');
    }
    function togglePasswordVisibility(){
        var passwordInput = document.getElementById('password');
        var icon = document.getElementById('togglePassword');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>
<script src="includes/jquery/jquery-min.js"></script>
<script src="library/js/workers.js"></script>
<?php include("library/php/loader.php");?>
</html>
