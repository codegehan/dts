function ResetForm(){
    $('#addNewOfficerForm')[0].reset();
}
function SelectedOffice()
{
    const office = $('#office').val();
    const randomNumbers = Math.floor(Math.random() * 1000).toString().padStart(4, '0');
    $('#username').val(office + '-' + randomNumbers);
    $('#usernamedisplay').val(office + '-' + randomNumbers);
}
function GetEmployees(){
    Tools.FetchRecord('controller/viewing.php', 'getemployee', '123', '#employeeBody', '#employeeTable');
}
GetEmployees();
function SaveOfficerConfirmation(){
    Swal.fire({
    title: "Sure to add this officer?",
    showCancelButton: true,
    confirmButtonText: "Add",
    icon: 'question',
    }).then((result) => {
    if (result.isConfirmed) {
        var jsonData = Tools.GetInput('addNewOfficerForm');
        var empCode = document.getElementById('username').value;
        var signatureFile = document.getElementById('signature').files[0];
        var formData = new FormData();
        formData.append('employeeCode', empCode); // Append employee code
        formData.append('signature', signatureFile); // Append the file
        formData.append('path', '../../signatures/'); // Append the file
        $.ajax({
            url: 'controller/saveFiles.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('File uploaded successfully:', response);
                Tools.InsertRecord('controller/inserting.php', 'newemployee', jsonData);
                signatureFile.values = '';
                ResetForm();
                GetEmployees();
            },
            error: function(xhr, status, error) {
                console.error('File upload error:', xhr.responseText);
            }
        });
    }   
    });
}