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
            <span class="text-dark font-weight-bold fs-4">Outgoing Documents</span>
            <input type="hidden" id="actionofficer" value="<?=$user->usercode?>">
        </div>
    </div>
    <div class="row bg-light shadow border border-right-0 border-bottom-0">
    <table id="outgoingDocumentsTable" class="table text-align-left table-hover" style="width:100%;font-size: 12px;">
        <thead style="background-color:#00040d;">
            <tr>
                <th class="text-secondary text-start">Trans Code</th>
                <th class="text-secondary text-start">Action Officer</th>
                <th class="text-secondary text-start">Description</th>
                <th class="text-secondary text-start">Purpose</th>
                <th class="text-secondary text-start">Office Involved</th>
                <th class="text-secondary text-start">Urgency</th>
                <th class="text-secondary text-start">Date Request</th>
                <th class="text-secondary text-center">Status</th>
            </tr>
        </thead>
        <tbody id="outgoingDocumentsBody"></tbody>
    </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" id="t-code">
        <h5>Status: <span class="text-primary" id="status"></span></h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <div class="row mb-2">

            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="transactionNo">Transaction No</label>
                    <input type="text" class="form-control" id="transactionNo" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" disabled>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="purpose">Purpose</label>
                    <input type="text" class="form-control" id="purpose" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="officeInvolved">Office Involved</label>
                    <input type="text" class="form-control" id="officeInvolved" disabled>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="urgency">Urgency</label>
                    <input type="text" class="form-control" id="urgency" disabled>
                </div>
            </div>
        </div>
        <div class="my-3">
            <h5><i class="fa-solid fa-list-check"></i> <strong>DOCUMENT PROGRESS TABLE</strong></h5>
        </div>
        <table id="documentProgressTable" style="font-size: 12px;" class="table table-hover mt-1">
            <thead>
                <tr>
                <th class="bg-dark text-light" scope="col">Forwarded To</th>
                <th class="bg-dark text-light" scope="col">Status</th>
                <th class="bg-dark text-light" scope="col">Note</th>
                <th class="bg-dark text-light" scope="col" style="width:150px;">Last Updated</th>
                </tr>
            </thead>
            <tbody id="documentProgressTableBody"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="buttonForFile"><i class="fa-solid fa-eye"></i> View Attached File</button>
      </div>
    </div>
  </div>
</div>


<script src="../library/js/ccs_workers.js"></script>
<script src="js/outgoing_document_function.js"></script>
<?php include("context-menu/context-outgoing.php"); ?>
<?php include("footers.php"); ?>