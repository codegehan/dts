var selectedFile;
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
function SaveFile(file, transactioncode){
    document.getElementById('loader-upload').hidden = false;
    var formData = new FormData();
    formData.append('file', file);
    formData.append('transactioncode', transactioncode);
    $.ajax({
        url: 'controller/uploadFile.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error)
            
        }
    });
    document.getElementById('loader-upload').hidden = true;
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
            var transC = $('#transactionCode').val();
            var jsonData = Tools.GetInput('newDocumentForm');
            console.log(jsonData);
            Tools.InsertRecord('controller/inserting.php', 'newdocument', jsonData, ResetForm());
	        SaveFile(selectedFile, transC);
            ClearAttachment();
	        DocumentList();
            $('#addNewDocumentModal').modal('hide');
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
