<?php
include('header.php');

//get the details
$name = "";
$type = "";
$sex = "";
$joindate = "";
$renewaldate = "";
$status = "";
$id = $_SESSION["id"];
$sql = "SELECT name,sex,joindate,renewaldate,type FROM user where id='" . $id . "'";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $type = $row["type"];
        $sex = $row["sex"];
        $joindate = $row["joindate"];
        // $renewaldate = $row["renewaldate"];
    }
}

//get status
// $year="";
// if(preg_match('/\b\d{4}\b/', $renewaldate, $matches)){
//     $year = $matches[0];
//     if($year != date("Y")){
//         $status = "<div style='color:red;'>Your subscription has expired!</div>";
//     }else{
//         $status = "<div style='color:green;'>You are active member</div>";
//     }
// }

?>

<div class="container">
    <div class="card border-0 shadow-sm mb-4 hero">
        <div class="card-body">
            <h3>Welcome
                <b>
                    <?php echo $name; ?>
                </b>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="card border-0 shadow-sm bg-dark">
                <div class="card-body">
                    <small class="text-muted">Navigation</small>
                    <hr style="background-color: #666666;">
                    <div class="nav flex-column nav-pills mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true"><i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;My Profile</a>
                        <a class="nav-link" id="v-pills-payment-tab" data-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false"><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;My Payment</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h3>My Profile</h3>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ($name != "webmaster") {
                                        echo '<a href="#" class="btn btn-outline-info btn-block"><i class="far fa-edit"></i>&nbsp;&nbsp;Edit Profile</a>';
                                    } ?>
                                </div>
                            </div>
                            <hr>
                            <?php
                            if ($name == "webmaster") {
                                echo "<br><br><center><h3 class='text-muted'>This section is not applicable for Admin</h3></center><br><br>";
                            } else {
                                echo "Name :&nbsp;&nbsp;<b>" . $name . "</b><br>";
                                echo "Type of Membership :&nbsp;&nbsp;<b>" . $type . "</b><br>";
                                echo "Gender :&nbsp;&nbsp;<b>" . $sex . "</b><br>";
                                echo "Joining Date :&nbsp;&nbsp;<b>" . $joindate . "</b><br>";
                                // echo "Renewal Date :&nbsp;&nbsp;<b>" . $renewaldate . "</b><br>";
                                echo "Status :&nbsp;&nbsp;<b>" . $status . "</b>";
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h3>My Payment</h3>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ($name != "webmaster") {
                                        echo '<a href="#" class="btn btn-outline-info btn-block"><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;Add Payment</a>';
                                    } else {
                                        echo '';
                                    } ?>
                                </div>
                            </div>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Uploaded Date</th>
                                        <th scope="col">Receipt</th>
                                        <th scope="col">Payment Description</th>
                                        <th scope="col">Admin Approval</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($name == "webmaster") {
                                        echo "<br><br><center><h3 class='text-muted'>This section is not applicable for Admin</h3></center><br><br>";
                                    } else {
                                        $sql = "SELECT uploaded_date, receipt_img, payment_desc, approved FROM payment WHERE user_id='" . $id . "'";
                                        $result = $link->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {

                                                echo '
                                                    <tr>
                                                        <td>' . $row["uploaded_date"] . '</td>
                                                        <td><a href="' . $row["receipt_img"] . '" target="_blank">View receipt</a></td>
                                                        <td>' . $row["payment_desc"] . '</td>
                                                        <td>';
                                                            if ($row["approved"] == "approved") {
                                                                echo "<p style='color:#28a745'><i class='fas fa-check-circle'></i>&nbsp;&nbsp;Approved</div>";
                                                            } else {
                                                                echo "<p style='color:#dc3545'><i class='fas fa-pause-circle'></i>&nbsp;&nbsp;Pending</div>";
                                                            }

                                                        echo '</td>
                                                    </tr>
                                                ';
                                            }
                                        } else {
                                            echo '
                                                    <tr>
                                                        <td colspan="4">No payment record yet</td>
                                                    </tr>
                                                ';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>