<div class="card border-0 shadow-sm bg-dark">
    <div class="card-body">
        <small class="text-muted">Navigation</small>
        <hr style="background-color: #666666">
        <div class="nav flex-column nav-pills mt-3" aria-orientation="vertical">

            <?php
            $curPage = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
            ?>

            <a class="nav-link <?php if ($curPage == 'dashboard.php') echo 'active';
                                else echo ''; ?>" href="dashboard.php"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard</a>
            <a class="nav-link <?php if ($curPage == 'member.php') echo 'active';
                                else echo ''; ?>" href="member.php"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Member Directory</a>
            <a class="nav-link <?php if ($curPage == 'payment.php') echo 'active';
                                else echo ''; ?>" href="payment.php"><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;Manage Payment</a>
            <a class="nav-link <?php if ($curPage == 'activity.php') echo 'active';
                                else echo ''; ?>" href="activity.php"><i class="fas fa-ad"></i>&nbsp;&nbsp;&nbsp;Activity Board</a>
        </div>
    </div>
</div>