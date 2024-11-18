function GetCompletedRequest(){
    var actionofficer = document.getElementById('actionofficer').value;
    Tools.FetchRecord('controller/viewing.php', 'getdocument_completed', actionofficer,'#completedDocumentsBody', '#completedDocumentsTable');
}
GetCompletedRequest()

function viewPDF(filename) {
    if(filename === "null") {
        Swal.fire({
            title: 'No file attached',
            showConfirmButton: false,
            timer: 1500,
            icon: 'error'
        });
    } else {
        window.open('viewPDF.php?filename=' + encodeURIComponent(filename), '_blank');
    }
}

$(document).ready(function() {
    console.log("Showing progress...")
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