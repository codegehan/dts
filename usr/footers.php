    </div>
</div>
<div class="footer d-flex justify-content-end align-items-center text-uppercase" style="font-size: 12px;">
    <div class="d-flex justify-content-center pt-2 text-dark">
        <p class="pe-1">Account: </p>
        <span class="pe-3"><?=$user->fullname?></span>
    </div>
    <div class="d-flex justify-content-center pt-2 text-dark">
        <p class="pe-1">Office: </p>
        <span class="pe-3"><?=$user->office?></span>
    </div>
    <div class="d-flex justify-content-center pt-2 text-dark">
        <p class="pe-1">Campus: </p>
        <span class="pe-3"><?=$user->campus?></span>
    </div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/dts/library/php/loader.php');?>
<script src="<?=base_uri?>includes/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_uri?>includes/jquery/jquery-min.js"></script>
<script>
    document.querySelectorAll('table').forEach(function(table) { table.classList.add('table-bordered'); });
</script>
</body>
</html>