<?php include('context-style.php');?>
<div id="context-menu">
    <div class="item-context-menu">
        <i class="fa-solid fa-pen"></i>
        Edit
    </div>
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
                var rowId = document.getElementById("context-menu");
                console.log(rowId);
                // var rowDataElement = table.querySelector(`tr[data-row-id="${rowId}"]`);
                // if (rowDataElement) {
                //     // var firstColumnData = rowDataElement.querySelector('td:first-child').innerText;
                //     if(action.toUpperCase() === "EDIT"){
                //         // $('#exampleModal').find('#t-code').val(firstColumnData);
                //         $('#addNewOfficer').modal('show');
                //     }
                //     if (action.toUpperCase() === "REFRESH") {
                //         GetEmployees();
                //     }
                // } else {
                //     console.error(`Row with ID ${rowId} not found.`);
                // }
            });
        });
    });
</script>



<!-- TO DO UPDATE THE EMPLOYEE TABLE -->