<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Document Details</h5>
      </div>
      <div class="modal-body" style="max-height: 450px; overflow:scroll;">
        <div class="row pt-2">
            <div class="col-md-4">
                <label for="transactionCode">Transaction Code</label>
                <input type="text" class="form-control" value="12312312312" disabled>
            </div>
            <div class="col-md-4">
                <label for="transactionCode">Action Officer</label>
                <input type="text" class="form-control" value="12312312312" disabled>
            </div>
            <div class="col-md-4">
                <label for="transactionCode">Description</label>
                <input type="text" class="form-control" value="12312312312" disabled>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col-md-4">
                <label for="transactionCode">Purpose</label>
                <input type="text" class="form-control" value="12312312312" disabled>
            </div>
            <div class="col-md-4">
                <label for="transactionCode">Office Involved</label>
                <input type="text" class="form-control" value="12312312312" disabled>
            </div>
            <div class="col-md-4">
                <label for="transactionCode">Urgency</label>
                <input type="text" class="form-control" value="12312312312" disabled>
            </div>
        </div>

        <table id="receivedDocumentDetailsTable" class="table text-align-left table-hover mt-3" style="width:100%;font-size: 12px;">
            <thead class="bg-dark">
                <tr>
                    <th class="text-secondary text-start">Forwarded To</th>
                    <th class="text-secondary text-start">Status</th>
                    <th class="text-secondary text-start">Action By</th>
                    <th class="text-secondary text-start">Date</th>
                </tr>
            </thead>
            <tbody id="receivedDocumentDetailsBody">
                <tr>
                    <td>CAS</td>
                    <td>PENDING</td>
                    <td>GEHAN</td>
                    <td>2024-03-01</td>
                </tr>
                <tr>
                    <td>CAS</td>
                    <td>PENDING</td>
                    <td>GEHAN</td>
                    <td>2024-03-01</td>
                </tr>
                <tr>
                    <td>CAS</td>
                    <td>PENDING</td>
                    <td>GEHAN</td>
                    <td>2024-03-01</td>
                </tr>
                <tr>
                    <td>CAS</td>
                    <td>PENDING</td>
                    <td>GEHAN</td>
                    <td>2024-03-01</td>
                </tr>
                <tr>
                    <td>CAS</td>
                    <td>PENDING</td>
                    <td>GEHAN</td>
                    <td>2024-03-01</td>
                </tr>
            </tbody>
        </table>

        <div class="row pt-2">
            <div class="col-md-12">
                <label for="transactionCode">Remarks / Note</label>
                <textarea type="text" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col-md-12">
                <label for="transactionCode">Forward <span style="font-style:italic;font-size:12px;">(Optional)</span></label>
                <select class="form-control" name="documentForward" id="documentForward">
                    <option value="" selected></option>
                    <?php Option::Populate('getoffice', 'code', 'desc'); ?>
                </select>
            </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-check"></i> Complete</button>
        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> For Edit</button>
        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-share"></i> Forward</button>
      </div>
    </div>
  </div>
</div>