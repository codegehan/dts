function GetIncomingRequest(){
    var office = document.getElementById('office').value;
    Tools.FetchRecord('controller/viewing.php', 'getdocument_incoming', office, '#incomingDocumentsBody', '#incomingDocumentsTable');
}
GetIncomingRequest()