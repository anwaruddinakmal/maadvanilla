<?php
// Initialize the session
session_start();

// Include config file
require_once "includes/config.php";

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malaysian Association of Aesthetic Dentistry</title>
    <link rel="icon" type="image/png" href="img/logo.png" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="" width="100px" height="auto">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">What We Do</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Aesthetic Dentistry</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="ml-auto">

                    <?php
                    // Check if the user is already logged in, if yes then redirect him to dashboard page
                    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                    ?>
                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $_SESSION['email']; ?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <?php
                                if ($admin === true) {
                                    echo '<a class="dropdown-item" href="admin/dashboard.php">Administration</a>';
                                }
                                ?>
                                <a class="dropdown-item" href="admin/index.php">My Profile</a>
                                <a class="dropdown-item" href="auth/logout.php" style="color: red;">Log-Out</a>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <a href="auth/login.php" style="text-decoration: none;"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Sign-in</a>
                        <a href="auth/register.php" class="btn btn-outline-info ml-4">Register</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>