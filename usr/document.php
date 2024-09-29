<?php 
include("headers.php");
if(!Authorize::isAccountSecured()) {
    session_unset();
    session_destroy();
    header("Location: ../");
    exit();
}
include('viewprogress.php');
?>
<div class="container">
    <div class="row bg-light mb-2 shadow border border-right-0 border-bottom-0 rounded-top">
        <div class="col-xl-6 col-lg-6 py-1">
            <span class="text-dark font-weight-bold fs-4">Document</span>
            <input type="hidden" id="usercode" value="<?=$user->usercode?>">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 py-2">
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNewDocumentModal"><i class="lni lni-circle-plus"></i> NEW DOCUMENT</button>
    </div>
    <div class="row bg-light shadow border border-right-0 border-bottom-0">
    <table id="documentTable" class="table text-align-left table-hover" style="width:100%;font-size: 12px;">
        <thead style="background-color:#00040d;">
            <tr>
                <th class="text-secondary text-start">No</th>
                <th class="text-secondary text-start">Description</th>
                <th class="text-secondary text-start">Purpose</th>
                <th class="text-secondary text-start">Office Involved</th>
                <th class="text-secondary text-start">Urgency</th>
                <th class="text-secondary text-center">Status</th>
            </tr>
        </thead>
        <tbody id="documentBody"></tbody>
    </table>
    </div>
</div>
<?php 
    $viewProgress = New ViewProgress();
    $viewProgress->getProgress();
?>
<script src="../library/js/ccs_workers.js"></script>
<script src="js/new_document.js"></script>
<?php include("new_document.php"); ?>
<?php include("footers.php");?>