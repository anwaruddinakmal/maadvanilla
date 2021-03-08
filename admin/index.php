<?php
include ('header.php');
?>

<h1>this is admin page. hi <?php echo $_SESSION["email"]; ?></h1>
<a href="../index.php">home</a>
<a href="../auth/logout.php">logout</a>

<?php include ('footer.php'); ?>