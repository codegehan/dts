<style> #loader-upload {position: fixed;left: 0;top: 0;width: 100%;height:100%;z-index: 1000;background: rgba(255, 255, 255, 0.8);display: flex;justify-content: center;align-items: center;flex-direction:column;} #loader-upload img {width: 180px;margin-bottom:10px;} #loading-message span {font-size:14px;color:#000;}</style>
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
                    <label for="documentDescription" class="ms-2">Title</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-floating">
                    <input class="form-control text-uppercase" placeholder="Input purpose here" id="documentPurpose" name="documentPurpose"></input>
                    <label for="documentPurpose" class="ms-2">Purpose</label>
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
                    <select class="form-select" id="forwardedTo" aria-label="Forwarded To" name="forwardedTo">
                        <option selected></option>
                        <?php Option::Populate('getoffice', 'code', 'desc'); ?>
                    </select>
                    <label for="forwardedTo" class="ms-2">Forwarded To</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-floating">
                    <select class="form-select" id="urgencyLevel" aria-label="Urgency" name="urgencyLevel">
                        <option selected></option>
                        <?php Option::Populate('geturgency', 'description', 'description'); ?>
                    </select>
                    <label for="urgencyLevel" class="ms-2">Urgency</label>
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
