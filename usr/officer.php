<?php include('headers.php');?>
<div class="container">
    <div class="row bg-light mb-2 shadow border border-right-0 border-bottom-0 rounded-top">
        <div class="col-xl-6 col-lg-6 py-1">
            <span class="text-dark font-weight-bold fs-4">Officer</span>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 py-2">
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNewOfficer"><i class="lni lni-circle-plus"></i> NEW OFFICER</button>
    </div>
    <div class="row bg-light shadow border border-right-0 border-bottom-0">
    <table id="employeeTable" class="table" style="width:100%;font-size: 12px;">
        <thead style="background-color:#00040d;">
            <tr>
                <th class="text-secondary text-start">ID</th>
                <th class="text-secondary text-start">Fullname</th>
                <th class="text-secondary text-start">Office</th>
                <th class="text-secondary text-start">Email</th>
                <th class="text-secondary text-start">Phone Number</th>
            </tr>
        </thead>
        <tbody id="employeeBody"></tbody>
    </table>
    </div>
</div>
<script src="../library/js/ccs_workers.js"></script>
<script src="js/new_officer.js"></script>
<?php include('context-menu/context-officer.php');?>
<?php include('new_officers.php');?>
<?php include('footers.php');?>