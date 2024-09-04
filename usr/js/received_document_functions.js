var tcode;
function GetReceivedDocuments(){
    var usercode = document.getElementById('usercode').value;
    Tools.FetchRecord('controller/viewing.php', 'getdocument_received', usercode, '#receivedDocumentsBody', '#receivedDocumentsTable');
}
GetReceivedDocuments()

function GetList(){
    GetReceivedDocuments()
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
        // var filePath = '../files/';
        // window.open(filePath + filename, '_blank');
        window.location.href="./viewPDF.php?fileName=" + filename;
    }
}
$(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function () {
        tcode = $('#t-code').val();
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

function ValidateTransaction(modaltoshow,transactioncode){
    $('#exampleModal').modal('hide');
    $(modaltoshow).modal('show');
    $(transactioncode).val(tcode);
}

function CompleteTransactionButton(){
    var jsonData = Tools.GetInput('completeTransctionForm');
    // console.log(jsonData);
    Tools.InsertRecord('controller/inserting.php', 'settransctioncomplete', jsonData)
}
function ReturnTransactionButton(){
    var jsonData = Tools.GetInput('returnTransctionForm');
    // console.log(jsonData);
    Tools.InsertRecord('controller/inserting.php', 'settransctionreturn', jsonData)
}
function ForwardTransactionButton(){
    var jsonData = Tools.GetInput('forwardTransactionForm');
    // console.log(jsonData);
    Tools.InsertRecord('controller/inserting.php', 'settransctionforward', jsonData)
}


