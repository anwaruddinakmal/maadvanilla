<?php
require_once "../../includes/config.php";
$id = $_GET['id'];
$sql = "SELECT img_one FROM posts where id= $id";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $imgval = $row["img_one"];
        $path = '../../img/post_img/';

        echo $imgval;
        if (file_exists($path . $imgval)) {

            if (!unlink($path . $imgval)) {
                echo 'window.alert("cannot delete file!");</script>';
            } else {
                $sql = "DELETE FROM posts WHERE id = $id";
                if (mysqli_query($link, $sql)) {
                    mysqli_close($link);
                    header('Location: ../activity.php');
                    exit;
                } else {
                    echo "Error deleting record";
                }
            }
        } else {
            echo 'window.alert("not exists!");</script>';
        }
    }
}
