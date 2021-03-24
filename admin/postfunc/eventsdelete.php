<?php
require_once "../../includes/config.php";

$id = $_GET['id'];
$sql = "DELETE FROM posts WHERE id = $id"; 
if (mysqli_query($link, $sql)) {
    mysqli_close($link);
    header('Location: ../activity.php');
    exit;
} else {
    echo "Error deleting record";
}
?>