var selectedFile;
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
    $('#newDocumentForm')[0].reset();
}
function DocumentList(){
    var usercode = document.getElementById('usercode').value;
    Tools.FetchRecord('controller/viewing.php', 'getdocument_request', usercode, '#documentBody', '#documentTable');
}
DocumentList();
function SubmitNewDocument(){
    Swal.fire({
    title: "Sure to submit this document?",
    showCancelButton: true,
    confirmButtonText: "Submit",
    icon: 'question',
    }).then((result) => {
        if (result.isConfirmed) {
            $('#addNewDocumentModal').modal('hide');
            console.log("Selected File", selectedFile.name)
            var transC = $('#transactionCode').val();
            let jsonData = Tools.GetInput('newDocumentForm');
            let parsedData = JSON.parse(jsonData);
            let fileNameToSave = transC+"-"+selectedFile.name;
            parsedData.filename = fileNameToSave
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
