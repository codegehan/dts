function TrackTransaction(){
    var searchKey = $('#searchKey').val();

    var jsonData = JSON.stringify({
        transactioncode: searchKey
    });
    // console.log(jsonData)
    // var result = Tools.RecordData('../controller/fetching.php', 'track_document', jsonData);
    // console.log(result)
    $.ajax({
        url: 'controller/fetching.php',
        type: 'POST',
        data: {
            spname: 'track_document',
            jsonData: jsonData,
        },
        success: function(response) {
            var jsonString = response.replace(/\\/g, "");
            var preprocessedJsonString = jsonString.replace(/"{/g, '{').replace(/}"/g, '}');
            var parsedData = JSON.parse(preprocessedJsonString);
            console.log("PARSED DATA: " , parsedData)
            var statuscode = parsedData.statuscode;
            var resultBody = document.getElementById('track_result');
            if (statuscode === 1) {
                var transactioncode = parsedData.result.item.transactioncode;
                var description = parsedData.result.item.description;
                var requestingofficer = parsedData.result.item.officer;
                var purpose = parsedData.result.item.purpose;
                var officeinvolved = parsedData.result.item.officeinvolved;
                var urgency = parsedData.result.item.urgencylevel;
                var status = parsedData.result.item.status;
                var approveddate = parsedData.result.item.approveddate;
                var approvedby = parsedData.result.item.approvedby;
                var dateadded = parsedData.result.item.dateadded;
                var filename = parsedData.result.item.filename;
                let htmlContent = "";
                let bgColor = "";
                htmlContent = `
                    <div style="background-color: #FDDC5C;" class="rounded shadow mb-5">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-4">
                                <span>Transaction Code: ${transactioncode}</span>
                            </div>
                            <div class="col-md-4">
                                <span>Requesting Officer: ${requestingofficer}</span>
                            </div>
                            <div class="col-md-4">
                                <span>Current Status: ${status}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <span>Office Involved: ${officeinvolved}</span>
                            </div>  
                            <div class="col-md-4">
                                <span>Purpose: ${purpose}</span>
                            </div>
                            <div class="col-md-4">
                                <span>Urgency Level: ${urgency}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Description: ${description}</span>
                            </div>
                        </div>
                    </div>  
                </div>
                `;
                parsedData.result.details.details.forEach(detail => {  
                    switch(detail.status){
                        case "PENDING":
                            bgColor = "gray";
                            break;
                        case "WAITING":
                            bgColor = "blue";
                            break;
                        case "APPROVED":
                            bgColor = "green";
                            break;
                        case "DECLINED":
                            bgColor = "red";
                            break;
                        case "IN-PROGRESS":
                            bgColor = "violet";
                            break;
                        case "RETURNED":
                            bgColor = "orange";
                            break;
                        case "ON-HOLD":
                            bgColor = "pink";
                            break;
                        case "COMPLETE":
                            bgColor = "darkgreen";
                            break;
                    }
                    htmlContent += `
                        <div class="track-lines">
                            <div class="ver" style="background-color: ${bgColor}"></div>
                            <div class="hor" style="background-color: ${bgColor}"></div>
                            <div class="text-items-details">
                                <span><i>Document forwarded to: ${detail.forwardedto}. Date: ${detail.entereddate} Status: <span style="color: ${bgColor}">${detail.status}</span></i></span>
                            </div>
                        </div>
                    `;
                });
            resultBody.innerHTML = htmlContent;
            } else {
                resultBody.innerHTML = `
                    <div class="mt-2">
                        <h5 class="text-danger">No transaction code found</h5>
                    </div>
                `;

                setTimeout(function() {
                    resultBody.innerHTML = "";
                }, 2500);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}


function ValidateSignature(){
    var signatureCode = $('#signatureCode').val();
    var jsonData = JSON.stringify({
        signcode: signatureCode
    });
    $.ajax({
        url: 'controller/fetching.php',
        type: 'POST',
        data: {
            spname: 'signcheck',
            jsonData: jsonData,
        },
        success: function(response) { 
            var responseData = JSON.parse(response);
            var resultBody = document.getElementById('signrecord');
            let htmlContent = '';

            let fontColor = responseData.statuscode === 0 ? "red" : "green";
            let iconStyle = responseData.statuscode === 0 ? "lni-cross-circle" : "lni-checkmark-circle";
            let statusText = responseData.result;

            htmlContent = `
                <div class="mb-5">
                    <div style="font-size:5rem;color:${fontColor}" class="d-flex justify-content-center align-items-center">
                        <i class="lni ${iconStyle}"></i>
                        <span class="ms-3" style="font-size:2rem;">Signature record: <u>${signatureCode}</u> is <u>${statusText.toUpperCase()}</u></span> 
                    </div>
                </div>
            `;
            $('#signatureCode').val("");
            resultBody.innerHTML = htmlContent;
            setTimeout(function() {
                resultBody.innerHTML = "";
            }, 5000);
        },
        error: function(xhr, status, error) {
            console.error(xhr, status, error);
        }
    });
}