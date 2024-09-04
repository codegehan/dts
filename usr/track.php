<?php 
include("headers.php");
if(!Authorize::isAccountSecured()) {
    session_unset();
    session_destroy();
    header("Location: ../");
    exit();
}
?>
<style>
    .track-lines{
        margin-top: 5px;
    }
    .step span{
        padding: 5px 12px;
        border-radius: 50%;
        background-color: transparent;
        color: transparent;
        animation: stepAnimation 1s ease forwards;
        animation-delay: 1.8s;
    }
    .ver, .hor, .ext{
        margin-left: 10px;
    }
    .hor{
        height: 3px;
        width: 0;
        animation: horizontalAnimation 1s ease forwards;
        animation-delay: 0.8s;
    }
    .ver{
        width: 3px;
        height: 0;
        margin-bottom: -25px;
        animation: veticalAnimation 1s ease forwards;
    }
    .text-items-details{
        position: relative;
        opacity: 0;
        animation: item-details-info 1s ease forwards 1.8s;
        font-size: 12px;
    }
    .hor, .text-items-details{
        display: inline-flex;
    }
    @keyframes item-details-info{
        0%{
            opacity: 0;
        }
        100%{
            opacity: 1;
        }
    }
    @keyframes veticalAnimation {
        0% {
            height: 0;
        }
        100% {
            height: 60px;
        }
    }
    @keyframes stepAnimation {
        0% {
            color: transparent;
            background-color: transparent;
        }
        100% {
            color: #fff;
        }
    }
    @keyframes horizontalAnimation {
        0% {
            width: 0;
        }
        100% {
            width: 60px;
        }
    }
</style>
<div class="container">
    <div class="row bg-light mb-2 shadow border border-right-0 border-bottom-0 rounded-top">
        <div class="col-xl-6 col-lg-6 py-1">
            <span class="text-dark font-weight-bold fs-4">Track</span>
            <input type="hidden" id="usercode" value="<?=$user->usercode?>">
        </div>
    </div>
    
    <div class="row bg-light shadow border border-right-0 border-bottom-0">
        <div class="col-md-6">
            <div class="form-group my-4">
                <div class="d-flex">
                    <input type="text" id="searchKey" placeholder="Search transaction code here ..." class="form-control">
                    <button class="btn btn-sm btn-primary ms-3" onclick="TrackTransaction()">Search</button>
                </div>
            </div>
        </div>
        <div class="col-md-12" id="track_result"></div>
        <div class="pb-5"></div>
    </div>
</div>
<script src="../library/js/ccs_workers.js"></script>
<script src="js/track_document_function.js"></script>
<?php include("footers.php");?>