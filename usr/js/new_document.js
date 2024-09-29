var selectedFile;
let broadcastForwardOffice = [];
let communicationTypeFlags = '';
let jsonData = '';

function sweetAlert(title, icon){
    Swal.fire({
        title: title,
        showConfirmButton: false,
        timer: 2000,
        icon: icon
    });
}
function AttachFile(){
    document.getElementById('proposalAttachedFile').click();
}
function ProposalAttachedFile(){
    document.getElementById('proposalAttachedFile').addEventListener('change', (event) => {
        selectedFile = event.target.files[0];
        if(selectedFile) {
            document.getElementById('fileNameLabel').innerHTML = "<span class='text-dark'>File Attached: <span style='color:blue;'>" + selectedFile.name +"</span></span>";
        }
    });
}
function SaveFile(file, fileNameToSave){
    return new Promise((resolve, reject) =>{
        var formData = new FormData();
        formData.append('file', file);
        formData.append('fileNameToSave', fileNameToSave);
        document.getElementById('loader-upload').hidden = false;
        $.ajax({
            url: 'controller/uploadFile.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                resolve(true);
                document.getElementById('loader-upload').hidden = true;
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error)
                reject(false);
                document.getElementById('loader-upload').hidden = true;
            }
        });
    });
}
function ClearAttachment(){
    document.getElementById('proposalAttachedFile').value = '';
    document.getElementById('fileNameLabel').innerText = '';
}
function ResetForm(){
    jsonData = '';
    broadcastForwardOffice = [];
    $('#newDocumentForm')[0].reset();
    $('#directForwardedContainer').css('display', 'none');
    $('#broadcastForwardedContainer').css('display', 'none'); 
}
function DocumentList(){
    var usercode = document.getElementById('usercode').value;
    Tools.FetchRecord('controller/viewing.php', 'getdocument_request', usercode, '#documentBody', '#documentTable');
}
DocumentList();

function SubmitNewDocument(){
    const documentDescription = $('#documentDescription').val();
    const documentPurpose = $('#documentPurpose').val();
    const urgencyLevel = $('#urgencyLevel').val();
    const communicationType = $('#communicationType').val();

    if (documentDescription === "" || documentPurpose === "" || urgencyLevel === "" || communicationType === "") {
        sweetAlert("Please input all required fields", "error");
        return; // Exit the function if validation fails
    }

    var fileInput  = $('#proposalAttachedFile')[0];
    var selectedFile = fileInput.files[0];
    // Check if no file is selected
    if (!selectedFile) {
        Swal.fire({
            title: "Please attach a PDF file",
            showCancelButton: false,
            confirmButtonText: "Ok",
            icon: "error"
        });

        return;
    }
    // Optionally, check if the file is a PDF
    if (selectedFile.type !== 'application/pdf') {
        Swal.fire({
            title: "Only PDF files are allowed",
            showCancelButton: false,
            confirmButtonText: "Ok",
            icon: "error"
        });
        return;
    }

    Swal.fire({
    title: "Sure to submit this document?",
    showCancelButton: true,
    confirmButtonText: "Submit",
    icon: 'question',
    }).then((result) => {
        if (result.isConfirmed) {
            $('#addNewDocumentModal').modal('hide');
            // console.log("Selected File", selectedFile.name)
            var transC = $('#transactionCode').val();
            jsonData = Tools.GetInput('newDocumentForm');
            let parsedData = JSON.parse(jsonData);
            let fileNameToSave = transC + ".pdf";
            parsedData.filename = fileNameToSave
            // check if communication type is direct or broadcast for a json key
            if (communicationTypeFlags === 'broadcastMessageCommunication' && broadcastForwardOffice.length > 0) {
                parsedData.broadcastOffices = broadcastForwardOffice.map(item => JSON.parse(item)); // Convert back to objects
            }
            jsonData = JSON.stringify(parsedData);
	        SaveFile(selectedFile, fileNameToSave)
            .then(function(isFileSaved) {
                if (isFileSaved) {
                    Tools.InsertRecord('controller/inserting.php', 'newdocument', jsonData, ResetForm());
                } else {
                    sweetAlert("Failed to upload file", "error");
                }
            })
            .catch(function() {
                sweetAlert("Failed to upload file", "error");
            })
            .finally(function(){
                ClearAttachment();
                DocumentList();
            })  
        } 
    });
}

function viewPDF(filename) {
    if(filename === "null") {
        Swal.fire({
            title: 'No file attached',
            showConfirmButton: false,
            timer: 1500,
            icon: 'error'
        });
    } else {
        var filePath = '../files/';
        window.open(filePath + filename, '_blank');
        // window.location.href="./viewPDF.php?fileName=" + filename;
    }
}

let selectedValues = [];

function toggleDropdown() {
    const dropdown = document.getElementById('dropdownOptions');
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

function updateSelection() {
    const checkboxes = document.querySelectorAll('#dropdownOptions input[type="checkbox"]');
    selectedValues = [];
    let displayText = [];
    broadcastForwardOffice = [];
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            if (!broadcastForwardOffice.some(item => JSON.parse(item).forwardedTo === checkbox.value)) {
                broadcastForwardOffice.push(
                    JSON.stringify({
                        forwardedTo: checkbox.value
                    })
                );
            }
            selectedValues.push(checkbox.value);
            displayText.push(checkbox.parentNode.textContent.trim());
        } else {
            broadcastForwardOffice = broadcastForwardOffice.filter(function(item) {
                return JSON.parse(item).forwardedTo !== checkbox.value;
            });
        }
    });

    document.getElementById('broadcastOffices').value = displayText.join(', ');
    console.log("Data: ", broadcastForwardOffice)
}
function CommunicationTypeChanged() {
    var commType = document.getElementById('communicationType').value;
    var directForward = document.getElementById('directForwardedContainer');
    var broadcasrForward = document.getElementById('broadcastForwardedContainer');
    if(commType === 'direct'){
        directForward.style.display = "block"
        broadcasrForward.style.display = "none"
        document.getElementById('forwardedTo').setAttribute('name', 'forwardedTo');
        communicationTypeFlags = 'directMessageCommunication';
    } else if(commType === 'broadcast'){
        broadcasrForward.style.display = "block"
        directForward.style.display = "none"
        document.getElementById('forwardedTo').removeAttribute('name', 'forwardedTo');
        communicationTypeFlags = 'broadcastMessageCommunication';
    } else {
        directForward.style.display = "none";
        broadcasrForward.style.display = "none";
        communicationTypeFlags = '';
    }
}

// Close the dropdown if clicked outside
window.onclick = function(event) {
    if (!event.target.closest('#customMultiSelect')) {
        document.getElementById('dropdownOptions').style.display = "none";
    }
};













$(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function () {
        var tcode = $('#t-code').val();
        Tools.RecordData('controller/inserting.php', 'getdocumentdetails', tcode)
            .then(function(record) {
                $('#transactionNo').val(record.transactioncode);
                $('#description').val(record.docdescription);
                $('#purpose').val(record.docpurpose);
                $('#officeInvolved').val(record.officeinvolved);
                $('#urgency').val(record.urgencylevel);
                $('#status').text(record.status);
                $('#buttonForFile').attr('onclick', "viewPDF('" + record.filename + "')");
            })
            .catch(function(error) {
                console.error('Error fetching record:', error);
            });
        Tools.FetchRecord('controller/viewing.php', 'getdocumentprogress', tcode, '#documentProgressTableBody');
    });
});
