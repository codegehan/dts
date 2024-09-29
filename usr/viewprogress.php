<style>
body{
    margin: 0px;
    font-family: 'Poppins', sans-serif;
}
#context-menu{
    position: fixed;
    z-index: 10000;
    width: 150px;
    background: #00040d;
    transform: scale(0);
    transform-origin: top left;
}
#context-menu.active{
    transform:scale(1);
    transition: transform 100ms ease-in-out;
}
#context-menu .item-context-menu{
    padding: 4px 10px;
    font-size: 15px;
    color: #eee;
}
#context-menu .item-context-menu:hover{
    background: #555;
    color: #00040d;
    cursor: pointer;
}
#context-menu .item-context-menu i{
    display: inline-block;
    margin-right: 5px;
}
</style>
<?php 
class ViewProgress{
    public static function getProgress() { ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="t-code">
                    <h5>Status: <span class="text-primary" id="status"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row mb-2">

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transactionNo">Transaction No</label>
                                <input type="text" class="form-control" id="transactionNo" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="purpose">Purpose</label>
                                <input type="text" class="form-control" id="purpose" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="officeInvolved">Office Involved</label>
                                <input type="text" class="form-control" id="officeInvolved" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="urgency">Urgency</label>
                                <input type="text" class="form-control" id="urgency" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <h5><i class="fa-solid fa-list-check"></i> <strong>DOCUMENT PROGRESS TABLE</strong></h5>
                    </div>
                    <table id="documentProgressTable" class="table table-hover mt-1">
                        <thead>
                            <tr>
                            <th class="bg-dark text-light" scope="col">Forwarded To</th>
                            <th class="bg-dark text-light" scope="col">Status</th>
                            <th class="bg-dark text-light" scope="col">Note</th>
                            <th class="bg-dark text-light" scope="col" style="width:150px;">Last Updated</th>
                            </tr>
                        </thead>
                        <tbody id="documentProgressTableBody"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="buttonForFile"><i class="fa-solid fa-eye"></i> View Attached File</button>
                </div>
                </div>
            </div>
        </div>


        <div id="context-menu">
            <div class="item-context-menu">
                <i class="fa-solid fa-eye"></i>
                View
            </div>
            <div class="item-context-menu">
                <i class="fa-solid fa-rotate"></i>
                Refresh
            </div>
        </div>

        <script>
            var documentNo;
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
                            documentNo = rowDataElement.querySelector('td:first-child').innerText;
                            if(action.toUpperCase() === "VIEW"){ 
                                $('#exampleModal').find('#t-code').val(documentNo);
                                $('#exampleModal').modal('show');
                            }
                            if (action.toUpperCase() === "REFRESH") {
                            DocumentList()
                            }
                        } else {
                            console.error(`Row with ID ${rowId} not found.`);
                        }
                    });
                });
            });
        </script>
    <?php }
}

?>