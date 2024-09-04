<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("headers.php");
class StatusCounter {
    public static function getStatusClass($count) {
        if ($count > 10) {
            return 'text-danger';
        } elseif ($count > 5) {
            return 'text-warning';
        } elseif($count >= 3) {
            return 'text-primary';
        } else {
            return 'text-light';
        }
    }
}
?>
<style>.a-hover:hover{text-decoration: underline;}
</style>
<div class="container">
    <div class="row bg-light mb-3 shadow border border-right-0 border-bottom-0 rounded-top">
        <div class="col-xl-3 col-lg-6 py-1">
            <span class="text-dark font-weight-bold fs-4">Dashboard</span>
        </div>
    </div>
    <div class="row bg-light shadow border border-right-0 border-bottom-0">
        <div class="col-xl-3 col-lg-6 pt-4">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large pe-4"><i class="fas fa-hourglass-end"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">
                            <a href="<?=base_uri?>usr/document.php" class="text-light a-hover"> Waiting for Actions </a>
                        </h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 <?= StatusCounter::getStatusClass($statusCount['pending']) ?>">
                                <?=$statusCount['pending']?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 pt-4">
            <div class="card l-bg-gray-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large pe-4"><i class="fas fa-download"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">
                            <a href="<?=base_uri?>usr/incoming.php" class="text-light a-hover"> Incoming </a>
                        </h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 <?= StatusCounter::getStatusClass($statusCount['incoming']) ?>">
                                <?=$statusCount['incoming']?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 pt-4">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large pe-4"><i class="fas fa-upload"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">
                            <a href="<?=base_uri?>usr/outgoing.php" class="text-light a-hover">Outgoing </a>
                        </h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 <?= StatusCounter::getStatusClass($statusCount['outgoing']) ?>">
                                <?=$statusCount['outgoing']?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 pt-4">
            <div class="card l-bg-gray-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large pe-4"><i class="fas fa-download"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">
                            <a href="<?=base_uri?>usr/received.php" class="text-light a-hover"> Received </a>
                        </h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 <?= StatusCounter::getStatusClass($statusCount['received']) ?>">
                                <?=$statusCount['received']?>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-xl-3 col-lg-6 pt-4">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large pe-4"><i class="fas fa-spinner"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">In progress</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                0
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-gray-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large pe-4"><i class="fas fa-ban"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Declined</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                0
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-gray-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large pe-4"><i class="fas fa-thumbs-up"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Approved</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                0
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-gray-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large pe-4"><i class="fas fa-magnifying-glass"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Track</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0 ">
                                0
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        
    </div>
</div>
<?php include("footers.php");?> 
