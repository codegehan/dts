function DocumentList(){
    var usercode = document.getElementById('usercode').value;
    Tools.FetchRecord('controller/viewing.php', 'getdocument_processed', usercode, '#documentBodyProcessed', '#documentTableProcessed');
    console.log(usercode)
}
DocumentList();
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
    $('#processedDocument').on('show.bs.modal', function () {
        var tcode = $('#t-code').val();
        Tools.RecordData('controller/inserting.php', 'getdocumentdetails', tcode)
            .then(function(record) {
                $('#transactionNoProcessed').val(record.transactioncode);
                $('#descriptionProcessed').val(record.docdescription);
                $('#purposeProcessed').val(record.docpurpose);
                $('#officeInvolvedProcessed').val(record.officeinvolved);
                $('#urgencyProcessed').val(record.urgencylevel);
                $('#statusProcessed').text(record.status);
                $('#buttonForFile').attr('onclick', "viewPDF('" + record.filename + "')");
            })
            .catch(function(error) {
                console.error('Error fetching record:', error);
            });
        Tools.FetchRecord('controller/viewing.php', 'getdocumentprogress', tcode, '#documentProgressTableBody');
    });
});
