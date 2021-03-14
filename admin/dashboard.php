<?php
include('header.php');
if (!isset($_SESSION["admin"]) && $_SESSION["admin"] !== true) {
    header("location: ../index.php");
    exit;
}

//get approval count
$paycount = 0;
$sql = "SELECT id FROM payment where user_id='" . $_SESSION["id"] . "'";
if ($result = mysqli_query($link, $sql)) {
    $rowcount = mysqli_num_rows($result);
    $paycount = $rowcount;
    mysqli_free_result($result);
}else{
    $paycount = 0;
}

//get member count
$membercount = 0;
$sql = "SELECT id FROM user";
if ($result = mysqli_query($link, $sql)) {
    $rowcount = mysqli_num_rows($result);
    $membercount = $rowcount;
    mysqli_free_result($result);
}else{
    $membercount = 0;
}

//get miss pay count
$misscount = "N/A";

//get new member count
$newcount = 0;
$ynow = date("Y");
$mnow = date("m");
$sql = "SELECT id FROM user WHERE YEAR(created_at) = ". $ynow ." and MONTH(created_at) = ". $mnow ."";
if ($result = mysqli_query($link, $sql)) {
    $rowcount = mysqli_num_rows($result);
    $newcount = $rowcount;
    mysqli_free_result($result);
}else{
    $newcount = 0;
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3 mt-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Navigation</small>
                    <hr>
                    <div class="nav flex-column nav-pills mt-3" aria-orientation="vertical">
                        <a class="nav-link active" href="dashboard.php"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard</a>
                        <a class="nav-link" href="member.php"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Member Directory</a>
                        <a class="nav-link" href="payment.php"><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;Manage Payment</a>
                        <a class="nav-link" href="activity.php"><i class="fas fa-ad"></i>&nbsp;&nbsp;&nbsp;Activity Board</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card border-0 shadow-sm mt-4 mb-4 hero2">
                <div class="card-body">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm" style="background-color:#DC3545;color:#ffffff;">
                        <div class="card-body">
                            <a style="font-size:18px">Payment Approval</a><br>
                            <b style="font-size:70px;padding-top:-30px"><?php echo $paycount ?></b><br>
                            <a href="#" style="color: #ffffff;opacity: 0.5;">Take Action ></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm" style="background-color:#28A745;color:#ffffff;">
                        <div class="card-body">
                            <a style="font-size:18px">Registered Member</a><br>
                            <b style="font-size:70px;padding-top:-30px"><?php echo $membercount ?></b><br>
                            <a href="#" style="color: #ffffff;opacity: 0.5;">Show me ></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm" style="background-color:#6C757D;color:#ffffff;">
                        <div class="card-body">
                            <a style="font-size:18px">Missed Payment</a><br>
                            <b style="font-size:70px;padding-top:-30px"><?php echo $misscount ?></b><br>
                            <a href="#" style="color: #ffffff;opacity: 0.5;">Show me ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm" style="background-color:#343a40;color:#ffffff;">
                        <div class="card-body">
                            <a style="font-size:18px">New Member</a><br>
                            <b style="font-size:70px;padding-top:-30px"><?php echo $newcount; ?></b><br>
                            <a href="#" style="color: #ffffff;opacity: 0.5;">Show me ></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm" style="background-color:#007BFF;color:#ffffff;">
                        <div class="card-body">
                            <a style="font-size:18px">Active Events</a><br>
                            <b style="font-size:70px;padding-top:-30px">100</b><br>
                            <a href="#" style="color: #ffffff;opacity: 0.5;">Update Now ></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 shadow-sm" style="background-color:#17a2b8;color:#ffffff;">
                        <div class="card-body">
                            <a style="font-size:18px">Today Posts</a><br>
                            <b style="font-size:70px;padding-top:-30px">100</b><br>
                            <a href="#" style="color: #ffffff;opacity: 0.5;">Update Now ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>