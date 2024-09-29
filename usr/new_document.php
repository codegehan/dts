<style> #loader-upload {position: fixed;left: 0;top: 0;width: 100%;height:100%;z-index: 1000;background: rgba(255, 255, 255, 0.8);display: flex;justify-content: center;align-items: center;flex-direction:column;} #loader-upload img {width: 180px;margin-bottom:10px;} #loading-message span {font-size:14px;color:#000;}</style>
<style>
.custom-multiselect {
    position: relative;
    display: inline-block;
    width: 100%;
}

.custom-multiselect input {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
}

.custom-multiselect input:focus {
    border-color: #007bff;
}

.dropdown-options {
    display: none;
    position: absolute;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dropdown-options label {
    cursor: pointer;
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    font-size: 1rem;
    padding: 0px 0px 0px 10px;
}

.dropdown-options label:hover {
    background-color: #0000FF;
    color: #fff;
}

</style>
<div id="loader-upload" hidden><img src="../includes/img/loader.gif" alt="Loading..."><div id="loading-message"><span>Uploading file...</span></div></div>
<div class="modal fade" id="addNewDocumentModal" tabindex="-1" aria-labelledby="addNewDocumentModalLabel" style="font-size: 14px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #132075;">
        <h5 class="modal-title fs- text-light" id="addNewDocumentModalLabel">New document</h5>
      </div>
      <form id="newDocumentForm">
        <div class="modal-body">
            <div class="row mb-2">
                <div class="form-floating">
                    <input type="hidden" class="form-control text-uppercase" id="actionOfficer" name="actionOfficer" value="<?=$user->usercode?>"></input>
                    <input type="hidden" class="form-control text-uppercase" id="transactionCode" name="transactionCode" value="<?=date('mdyhis')?>"></input>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-floating">
                    <textarea class="form-control text-uppercase" placeholder="Input description here" id="documentDescription" name="documentDescription" style="height: 60px"></textarea>
                    <label for="documentDescription" class="ms-2">Title <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-floating">
                    <input class="form-control text-uppercase" placeholder="Input purpose here" id="documentPurpose" name="documentPurpose"></input>
                    <label for="documentPurpose" class="ms-2">Purpose <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-floating">
                    <input class="form-control text-uppercase" placeholder="Input purpose here" id="officeInvolved" name="officeInvolved"></input>
                    <label for="officeInvolved" class="ms-2">Office Involved</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-floating">
                    <select class="form-select" id="urgencyLevel" aria-label="Urgency" name="urgencyLevel">
                        <option selected></option>
                        <?php Option::Populate('geturgency', 'description', 'description'); ?>
                    </select>
                    <label for="urgencyLevel" class="ms-2">Urgency <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="row mb-2">
                <div class="form-floating">
                    <select class="form-select" onchange="CommunicationTypeChanged()" id="communicationType" aria-label="Urgency" name="communicationType">
                        <option selected></option>
                        <option value="direct">Direct</option>
                        <option value="broadcast">Broadcast</option>
                    </select>
                    <label for="communicationType" class="ms-2">Communication Type <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="row mb-2" id="directForwardedContainer" style="display:none;">
                <div class="form-floating">
                    <select class="form-select" id="forwardedTo" aria-label="Forwarded To">
                        <option selected></option>
                        <?php Option::Populate('getoffice', 'code', 'desc'); ?>
                    </select>
                    <label for="forwardedTo" class="ms-2">Forwarded To</label>
                </div>
            </div>


            <div class="row mb-2" id="broadcastForwardedContainer" style="display:none;">
                <label for="forwardedToInput" class="ms-2">Forwarded To</label>
                <div id="customMultiSelect" class="custom-multiselect">
                    <input type="text" id="broadcastOffices" placeholder="Select Office(s)" readonly onclick="toggleDropdown()">
                    <div id="dropdownOptions" class="dropdown-options">
                        <?php Option::PopulateBroadcast('getoffice', 'code', 'desc'); ?>
                    </div>
                </div>
            </div>
            <a id="fileNameLabel" class="link-opacity-100" style="font-size: 12px;"></a>
        </div>
        <div class="modal-footer">
            <input type="file" id="proposalAttachedFile" accept="application/pdf" onclick="ProposalAttachedFile()" style="display: none;">
            <button type="button" onclick="AttachFile()" class="btn btn-secondary btn-sm">Attach a File</button>
            <button type="button" onclick="ClearAttachment()" class="btn btn-secondary btn-sm">Clear File</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="ResetForm()">Reset</button>
            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" aria-label="Close">Hide</button>
            <button type="button" onclick="SubmitNewDocument()" class="btn btn-primary btn-sm">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
