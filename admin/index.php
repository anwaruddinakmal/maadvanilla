<?php
include('header.php');

//get the details
$name = "";
$type = "";
$sex = "";
$joindate = "";
$status = "";
$id = $_SESSION["id"];
$admin = $_SESSION["admin"];
$sql = "SELECT name,type,sex,joindate,status FROM user where id='" . $id . "'";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $type = $row["type"];
        $sex = $row["sex"];
        $joindate = $row["joindate"];
        $status = $row["status"];
    }
}
?>

<div class="container">
    <div class="card border-0 shadow-sm mt-4 mb-4 hero">
        <div class="card-body">
            <h3>Welcome
                <b>
                    <?php echo $name; ?>
                </b>
            </h3>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>My Profile</h3>
            <hr>
            <?php
                if (isset($_SESSION["admin"]) === true) {
                    echo "<br><br><h3 class='text-muted'>This section is not applicable for Admin</h3>";
                }else{
                    echo "Name :".$name;
                    echo "Name :".$name;
                    echo "Name :".$name;
                }
            ?>

            <p>
                Name : <b><?php echo $name; ?></b><br>
                Type of Membership : <b><?php echo $type; ?></b><br>
                Gender : <b><?php echo $sex; ?></b><br>
                Joining Date : <b><?php echo $joindate; ?></b><br>
                Status : <b><?php echo $status; ?></b>
                <?php echo $_SESSION['admin']; ?>
            </p>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>