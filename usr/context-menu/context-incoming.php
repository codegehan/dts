<?php include('context-style.php');?>
<div id="context-menu">
    <div class="item-context-menu">
        <i class="fa-solid fa-eye"></i>
        View
    </div>
    <div class="item-context-menu">
        <i class="fa-solid fa-thumbs-up"></i>
        Receive 
    </div>
    <div class="item-context-menu">
        <i class="fa-solid fa-ban"></i>
        Decline
    </div>
    <!-- <div class="item-context-menu">
        <i class="fa-solid fa-hand"></i>
        On-Hold
    </div> -->
    <!-- <div class="item-context-menu">
        <i class="fa-solid fa-file-pen"></i>
        For Edit
    </div> -->
    <div class="item-context-menu">
        <i class="fa-solid fa-rotate"></i>
        Refresh
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var table = document.querySelector('table');
        table.addEventListener("contextmenu", function(event) {
            event.preventDefault();
            var contextElement = document.getElementById("context-menu");
            contextElement.style.top = event.clientY + "px";
            contextElement.style.left = event.clientX + "px";
            contextElement.classList.remove('active');
            setTimeout(function () {
                contextElement.classList.add('active');
            }, 10);
            var clickedRow = event.target.closest('tr');
            contextElement.dataset.rowId = clickedRow.dataset.rowId;            
        });
        window.addEventListener("click", function(){
            document.getElementById("context-menu").classList.remove('active');
        });
        document.querySelectorAll('.item-context-menu').forEach(item => {
            item.addEventListener('click', function() {
                var action = this.textContent.trim();
                var rowId = document.getElementById("context-menu").dataset.rowId;
                var rowDataElement = table.querySelector(`tr[data-row-id="${rowId}"]`);
                if (rowDataElement) {
                    var transactioncode = rowDataElement.querySelector('td:first-child').innerText;
                    var usercode = document.getElementById('usercode');
                    var office = document.getElementById('office');
                    
                    if(action.toUpperCase() === "RECEIVE"){
                        var jsonData = JSON.stringify({
                            transactioncode: transactioncode,
                            user: usercode.value,
                            office: office.value,
                            approvedstatus: 4,
                        });
                        Tools.InsertRecord('controller/inserting.php', 'document_incoming_validate', jsonData);
                        GetIncomingRequest();
                        console.log(jsonData)
                    }
                    if(action.toUpperCase() === "DECLINE"){
                        var jsonData = JSON.stringify({
                            transactioncode: transactioncode,
                            approvedstatus: 0,
                        });
                        Tools.InsertRecord('controller/inserting.php', 'document_incoming_validate', jsonData);
                        GetIncomingRequest();
                    }
                    if(action.toUpperCase() === "VIEW"){
                        firstColumnData = rowDataElement.querySelector('td:first-child').innerText;
                        // console.log("Viewing", firstColumnData);
                        // var filePath = '../files/';
                        // window.open(filePath + firstColumnData + '.pdf', '_blank');
                        // $('#exampleModal').find('#t-code').val(firstColumnData);
                        // $('#exampleModal').modal('show');
                        window.open('viewPDF.php?filename=' + encodeURIComponent(firstColumnData), '_blank');
                    }
                    // if(action.toUpperCase() === "FOR EDIT"){
                    //     var jsonData = JSON.stringify({
                    //         transactioncode: transactioncode,
                    //         approvedstatus: 6,
                    //     });
                    //     Tools.InsertRecord('controller/inserting.php', 'document_incoming_validate', jsonData);
                    //     GetIncomingRequest();
                    // }
                    if (action.toUpperCase() === "REFRESH") {
                        GetIncomingRequest();
                    }
                } else {
                    console.error(`Row with ID ${rowId} not found.`);
                }
            });
        });
    });

    // START LOGIC HEREE ===========================================================================================================
    function DocumentApprove(docid){
        
    }

</script>