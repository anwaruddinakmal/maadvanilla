<?php
include('header.php');
if (!isset($_SESSION["admin"]) && $_SESSION["admin"] !== true) {
    header("location: ../index.php");
    exit;
}
?>
<div class="container">
    <h1>dashboard</h1>
</div>
<?php include('footer.php'); ?>