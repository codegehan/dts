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
            <span class="text-dark font-weight-bold fs-4">Received Documents</span>
            <input type="hidden" id="usercode" value="<?=$user->office?>">
        </div>
    </div>
    <div class="row bg-light shadow border border-right-0 border-bottom-0">
    <table id="receivedDocumentsTable" class="table text-align-left table-hover" style="width:100%;font-size: 12px;">
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
        <tbody id="receivedDocumentsBody"></tbody>
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
        <button type="button" class="btn btn-secondary text-danger" id="buttonForFile"><i class="fa-solid fa-eye"></i> View Attached File</button>
        <button type="button" class="btn btn-primary" onclick="ValidateTransaction('#completeTransaction','.transactionCode')"><i class="lni lni-checkmark-circle"></i> Complete</button>
        <button type="button" class="btn btn-primary" onclick="ValidateTransaction('#returnTransaction','.transactionCode')"><i class="lni lni-reply"></i> Return</button>
        <button type="button" class="btn btn-primary" onclick="ValidateTransaction('#forwardToTransaction','.transactionCode')"><i class="lni lni-share"></i> Forward To</button>
      </div>
    </div>
  </div>
</div>

<!-- FOR A COMPLETE TRANSACTION -->
<div class="modal fade" id="completeTransaction" tabindex="-1" role="dialog" aria-labelledby="completeTransactionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="completeTransactionLabel">Addtional Information</h5>
      </div>
      <div class="modal-body">
        <form id="completeTransctionForm">
          <div class="form-group">
              <label for="officeInvolved">Remarks / Note</label>
              <input type="hidden" name="validatingOfficer" id="actionOfficerTransactionComplete" class="actionOfficerTransaction" value="<?=$officerCode?>">
              <input type="hidden" name="transactionCode" id="transactionCodeComplete" class="transactionCode">
              <textarea name="transactionNote" class="form-control" id="" cols="30" rows="5"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="CompleteTransactionButton()" class="btn btn-primary">Complete</button>
      </div>
    </div>
  </div>
</div>
<!-- FOR A COMPLETE TRANSACTION -->

<!-- FOR RETURN TRANSACTION -->
<div class="modal fade" id="returnTransaction" tabindex="-1" role="dialog" aria-labelledby="returnTransactionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="returnTransactionLabel">Addtional Information</h5>
      </div>
      <div class="modal-body">
        <form id="returnTransctionForm">
          <div class="form-group">
              <label for="officeInvolved">Remarks / Note</label>
              <input type="hidden" name="validatingOfficer" id="actionOfficerTransactionReturn" class="actionOfficerTransaction" value="<?=$officerCode?>">
              <input type="hidden" name="transactionCode" id="transactionCodeReturn" class="transactionCode">
              <textarea name="transactionNote" class="form-control" id="" cols="30" rows="5"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="ReturnTransactionButton()" class="btn btn-primary">Return</button>
      </div>
    </div>
  </div>
</div>
<!-- FOR RETURN TRANSACTION -->

<!-- FORWARDED TO TRANSACTION -->
<div class="modal fade" id="forwardToTransaction" tabindex="-1" role="dialog" aria-labelledby="forwardToTransactionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forwardToTransactionLabel">Addtional Information</h5>
      </div>
      <div class="modal-body">
        <form id="forwardTransactionForm">
          <div class="form-group">
              <input type="hidden" name="validatingOfficer" id="actionOfficerTransactionForward" class="actionOfficerTransaction" value="<?=$officerCode?>">
              <input type="hidden" name="transactionCode" id="transactionCodeForward" class="transactionCode">
              <div class="form-group mb-2">
                <label for="transactionNote">Remarks / Note</label>
                <textarea name="transactionNote" id="transactionNote" class="form-control" cols="30" rows="5"></textarea>
              </div>
              <div class="form-group mb-2">
                <label for="officeToForward">Office To Forward</label>
                <select name="officeToForward" id="officeToForward" class="form-control">
                  <option value="#" selected></option>
                <?php Option::Populate('getoffice', 'code', 'desc'); ?>
                </select>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="ForwardTransactionButton()" class="btn btn-primary">Forward</button>
      </div>
    </div>
  </div>
</div>
<!-- FORWARDED TO TRANSACTION -->

<script src="../library/js/ccs_workers.js"></script>
<script src="js/received_document_functions.js"></script>
<?php include("context-menu/context-received.php"); ?>
<?php include("footers.php"); ?>