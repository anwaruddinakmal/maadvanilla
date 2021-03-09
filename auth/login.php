<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to dashboard page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../admin/index.php");
    exit;
}

// Include config file
require_once "../includes/config.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM user WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if email exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {

                            // check if the user is admin
                            $sql = "SELECT user_id FROM roles WHERE user_id = ?";
                            if ($stmt = mysqli_prepare($link, $sql)) {
                                mysqli_stmt_bind_param($stmt, "s", $param_id);
                                $param_id = $id;
                                if (mysqli_stmt_execute($stmt)) {
                                    if (mysqli_stmt_num_rows($stmt) == 1) {
                                        // Password is correct, so start a new session
                                        session_start();

                                        // Store data in session variables
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["email"] = $email;
                                        $_SESSION["admin"] = true;

                                        // Redirect user to index page
                                        header("location: ../admin/index.php");
                                    } else {
                                        // Password is correct, so start a new session
                                        session_start();

                                        // Store data in session variables
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["email"] = $email;
                                        $_SESSION["admin"] = false;

                                        // Redirect user to index page
                                        header("location: ../admin/index.php");
                                    }
                                }
                            }
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <style type="text/css">
        body {
            background: rgb(62, 173, 207);
            background: linear-gradient(90deg, rgba(62, 173, 207, 1) 0%, rgba(171, 233, 205, 1) 100%);
        }

        .content {
            margin-top: 80px;
            height: 200px;
            width: 400px;
            text-align: center;
        }

        .navbar {
            height: 70px;
        }

        a:hover {
            text-decoration: none;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="mr-auto">
            <a class="btn btn-info" href="../index.php"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back to homepage</a>
        </div>
    </nav>
    <div class="content mx-auto">
        <img src="../img/logo.png" width="250px" height="auto" style="padding-bottom:20px;"><br>
        <h3 style="color: #ffffff;"><b>Malaysian Association of Aesthetic Dentistry</b></h3>
        <br>
        <div class="card shadow">
            <div class="card-body">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email">
                        <span class="help-block"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" value="Login">
                    </div>
                    <a href="../auth/forgotpassword.php">Forgot your password?</a>
                </form>
            </div>
        </div>
        <br>
        <p style="color: #ffffff;">Don't have an account? <a href="../auth/register.php">Sign up now</a></p>
    </div>
</body>

</html>