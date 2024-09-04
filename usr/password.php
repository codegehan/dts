<?php  
include('headers.php'); 
if(isset($_POST["changePassBtn"])) {
    $oldp = $_POST["oldPassword"];
    $newp = $_POST["newPassword"];
    $confirmp = $_POST["confirmPassword"];

    if(strtoupper($oldp) != "PASSWORD") {
        echo '
            <script>
                Swal.fire({
                    title: "Old password not matched!",
                    icon: "error",
                    timer: 2000,
                    showConfirmButton: false,
                }).then(() => {
                    window.location.href = "./password.php";
                });
            </script>
        ';
        exit();
    }
}
?>
<style>
    .custom-label{
        font-size: 14px !important;
    }
</style>
<div class="container">
    <div class="row bg-light mb-2 shadow border border-right-0 border-bottom-0 rounded-top">
        <div class="col-xl-6 col-lg-6 py-1">
            <span class="text-dark font-weight-bold fs-4">Change Password</span>
            <input type="hidden" id="usercode" value="<?=$user->usercode?>">
        </div>
    </div>
    <div class="bg-primary p-3" style="max-width:300px;position:absolute;top:50%;left:60%;transform:translate(-50%,-60%);background: linear-gradient(to right, #ff9966, #ff5e62);border-radius:10px 10px 0 0;">
        <form id="changePasswordForm">
            <div class="form-group pb-2">
                <label for="oldPassword" class="custom-label">Old password</label>
                <input type="text" class="form-control" name="userCode" value="<?=$officerCode?>" hidden>
                <input type="password" class="form-control" name="oldPassword" placeholder="********" required maxLength="10">
            </div>
            <div class="form-group pb-2">
                <label for="newPassword" class="custom-label">New password</label>
                <input type="password" class="form-control" name="newPassword" id="oldPassword" placeholder="********" required maxLength="10" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,10}" title="Password must be 6-10 characters long and include at least one number, one lowercase letter, and one uppercase letter.">
            </div>
            <div class="form-group pb-2">
                <label for="confirmPassword" class="custom-label">Confirm password</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" aria-describedby="confirmPassword" placeholder="********" oninput="matchPassword()" required maxLength="10">
                <small class="form-text text-danger" id="errorMessage"></small>
            </div>
            <div class="pt-2">
                <button type="button" onclick="changePassword()" id="changePassBtn" class="btn btn-primary w-100" disabled>Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="../library/js/ccs_workers.js"></script>
<script>
    function matchPassword(){
        const newP = document.getElementById("oldPassword").value;
        const confirmP = document.getElementById("confirmPassword").value;
        const errorMsg = document.getElementById("errorMessage");
        const changePassBtn = document.getElementById("changePassBtn");

        if (newP !== confirmP) { errorMsg.innerText = "Password not matched!"} else { errorMsg.innerText = ""; changePassBtn.disabled = false;}
    }
    function changePassword(){
        Swal.fire({
        title: "Sure to save this password?",
        showCancelButton: true,
        confirmButtonText: "Save",
        icon: 'question',
        }).then((result) => {
        if (result.isConfirmed) {
            var jsonData = Tools.GetInput('changePasswordForm');
            Tools.InsertRecord('controller/inserting.php', 'changepassword', jsonData);
        }   
        });
    }
</script>
<?php  include('footers.php'); ?>