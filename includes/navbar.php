<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
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
                            <a class="dropdown-item" href="admin/dashboard.php">Administration</a>
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