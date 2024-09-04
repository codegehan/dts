<div class="modal fade" id="addNewOfficer" tabindex="-1" aria-labelledby="addNewOfficerLabel" aria-hidden="true" style="font-size: 12px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-light" id="addNewOfficerLabel">New Officer Registration</h1>
      </div>
      <form id="addNewOfficerForm">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 mb-2 form-floating">
                    <select class="form-select" id="office" aria-label="Office" name="office" required onchange="SelectedOffice()">
                        <option selected></option>
                        <?php Option::Populate('getoffice', 'code', 'desc');?>
                    </select>
                    <label for="office" class="ms-2">Office</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2 form-floating">
                    <select class="form-select" id="campus" aria-label="Office" name="campus" required>
                        <option selected></option>
                        <?php Option::Populate('getcampus', 'campusdes', 'campusdes');?>
                    </select>
                    <label for="office" class="ms-2">Campus</label>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 mb-2 form-floating">
                    <input type="text" class="form-control text-uppercase" placeholder="Input fullname here" id="fullname" name="fullname" required></input>
                    <label for="fullname" class="ms-2">Fullname</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2 form-floating">
                    <input type="hidden" class="form-control" id="username" name="username" required></input>
                    <input type="text" class="form-control" placeholder="Input username here" id="usernamedisplay" required disabled></input>
                    <label for="username" class="ms-2">Employee Code</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2 form-floating">
                    <input type="email" class="form-control text-uppercase" placeholder="Input Contact Email here" id="contactEmail" name="contactEmail" required></input>
                    <label for="contactEmail" class="ms-2">Contact Email</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2 form-floating">
                    <input type="text" class="form-control" type="text" maxlength="13" placeholder="Input Contact No here" id="contactNo" name="contactNo" required></input>
                    <label for="contactNo" class="ms-2">Contact No</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2 form-floating">
                    <input type="file" class="form-control d-none" id="signature" accept="image/png">
                    <button type="button" class="btn btn-primary btn-sm" id="uploadButton">Upload Signature</button>
                </div>
            </div>
            <div class="row mt-2 text-center">
                <div class="col-md-12 mb-2 form-floating">
                    <img id="signatureImage" src="" style="max-width: 250px; height: auto;">
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" onclick="ResetForm()" class="btn btn-sm btn-secondary">Reset</button>
            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary">Hide</button>
            <button type="button" class="btn btn-sm btn-primary" onclick="SaveOfficerConfirmation()">Save Officer</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the elements
    const fileInput = document.getElementById('signature');
    const uploadButton = document.getElementById('uploadButton');
    const signatureImage = document.getElementById('signatureImage');
    // When the button is clicked, trigger the file input
    uploadButton.addEventListener('click', function() {
        fileInput.click();
    });
    // When the file is selected, display the image
    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                signatureImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            alert('Please select a valid image file.');
        }
    });
});
</script>