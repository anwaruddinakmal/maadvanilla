<?php
// Initialize the session
session_start();

// Include config file
require_once "../includes/config.php";

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../auth/login.php");
    exit;
} else {
    //check roles
    $sql = "SELECT user_id FROM roles WHERE user_id = ?";
    $admin = false;

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_id);

        // Set parameters
        $param_id = $_SESSION["id"];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Store result
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                $admin = true;
            }else{
                $admin = false;
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaysian Association of Aesthetic Dentistry</title>
    <link rel="icon" type="image/png" href="../img/logo.png" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>

<body class="admin">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../img/logo.png" alt="" width="100px" height="auto">&nbsp;&nbsp;Malaysian Association of Aesthetic Dentistry
            </a>
            <div class="ml-auto">
                <?php
                // Check if the user is already logged in, if yes then redirect him to dashboard page
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                ?>
                    <div class="dropdown">
                        <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['email']; ?>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php
                            if($admin === true){
                                echo '<a class="dropdown-item" href="dashboard.php">Administration</a>';
                            }
                            ?>
                            <a class="dropdown-item" href="index.php">My Profile</a>
                            <a class="dropdown-item" href="../auth/logout.php" style="color: red;">Log-Out</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>