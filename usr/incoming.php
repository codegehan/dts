<?php 
include("headers.php"); 
if(!Authorize::isAccountSecured()) {
    session_unset();
    session_destroy();
    header("Location: ../");
    exit();
}
?>
<div class="container">
    <div class="row bg-light mb-2 shadow border border-right-0 border-bottom-0 rounded-top">
        <div class="col-xl-6 col-lg-6 py-1">
            <span class="text-dark font-weight-bold fs-4">Incoming Documents</span>
            <input type="hidden" id="usercode" value="<?=$user->usercode?>">
            <input type="hidden" id="office" value="<?=$user->office?>">
            <input type="hidden" id="campus" value="<?=$user->campus?>">
        </div>
    </div>
    <div class="row bg-light shadow border border-right-0 border-bottom-0">
    <table id="incomingDocumentsTable" class="table text-align-left table-hover" style="width:100%;font-size: 12px;">
        <thead style="background-color:#00040d;">
            <tr>
                <th class="text-secondary text-start">Trans Code</th>
                <th class="text-secondary text-start">Action Officer</th>
                <th class="text-secondary text-start">Description</th>
                <th class="text-secondary text-start">Purpose</th>
                <th class="text-secondary text-start">Office Involved</th>
                <th class="text-secondary text-start">Forwarded To</th>
                <th class="text-secondary text-start">Urgency</th>
                <th class="text-secondary text-start">Date Request</th>
            </tr>
        </thead>
        <tbody id="incomingDocumentsBody"></tbody>
    </table>
    </div>
</div>
<script src="../library/js/ccs_workers.js"></script>
<script src="js/incoming_document_function.js"></script>
<?php include("context-menu/context-incoming.php"); ?>
<?php include("footers.php"); ?>