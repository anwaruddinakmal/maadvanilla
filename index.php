<?php
include('includes/header.php');

//news
$sql = "SELECT title FROM posts where category='news' order by timestamp desc limit 1";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $titlenews = $row["title"];
    }
}else{
    $titlenews = 'No News Yet';
}

//events
$sql = "SELECT title FROM posts where category='events' order by timestamp desc limit 1";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $titleevent = $row["title"];
    }
}else{
    $titleevent = 'No Events Yet';
}

?>

<div class="hero-landing">
    <h1>Welcome to the</h1>
    <p style="font-size:60px;font-weight:bold"><a style="color: yellow">M</a>alaysian <a style="color: yellow">
            A</a>ssociation of<br><a style="color: yellow">A</a>esthetic <a style="color: yellow">D</a>entistry</p>
    <br>
    <a href="#" class="btn btn-warning btn-lg mr-5">Register Now</a><a href="#" style="color: white;">More Info</a>&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>
</div>
<div class="section1 pb-5 pt-5">
    <div class="row justify-content-sm-center" style="margin: 0;">
        <div class="col-sm-3 mr-5" style="text-align: center;">
            <i class="fas fa-building fa-3x mb-3"></i><br>
            <h5 class="mb-3"><b>About MAAD</b></h5>
            <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p><br>
            <a href="#" class="btn btn-outline-dark">More Info</a>
        </div>
        <div class="vl"></div>
        <div class="col-sm-3 mr-5 ml-5" style="text-align: center;">
            <i class="fas fa-user-md fa-3x mb-3"></i><br>
            <h5 class="mb-3"><b>Our Objectives</b></h5>
            <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p><br>
            <a href="#" class="btn btn-outline-dark">More Info</a>
        </div>
        <div class="vl"></div>
        <div class="col-sm-3 ml-5" style="text-align: center;">
            <i class="fas fa-file-alt fa-3x mb-3"></i><br>
            <h5 class="mb-3"><b>Join Us</b></h5>
            <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p><br>
            <a href="#" class="btn btn-outline-dark">Register Now</a>
        </div>
    </div>
</div>
<div class="section2">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <a href="news.php" style="text-decoration: none;">
                    <div class="card mt-5 mb-5">
                        <div class="card-body news p-5">
                            <h4 class="txt-shadow">Latest <b style="color:yellow">News</b></h4>
                            <hr style="width: 70px;background-color:#ffffff;margin-left:0">
                            <h4 class="txt-shadow"><?php echo $titlenews ?></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="events.php" style="text-decoration: none;">
                    <div class="card mt-5 mb-5">
                        <div class="card-body events p-5">
                            <h4 class="txt-shadow">Latest <b style="color:yellow">Events</b></h4>
                            <hr style="width: 70px;background-color:#ffffff;margin-left:0">
                            <h4 class="txt-shadow"><?php echo $titleevent ?></h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="section3 pt-5 pb-5">
    <div class="container">
        <h3 class="mb-4"><b>Join Our Community</b></h3>
        <p class="mb-5">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius dignissimos rerum neque ipsam ratione alias temporibus consectetur.Eius dignissimos rerum neque ipsam ratione alias temporibus consectetur
        </p>
        <div class="row justify-content-sm-center">
            <div class="col-sm-4">
                <div class="card border-0 shadow">
                    <h5 class="card-header border-0">Undergraduate</h5>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size:30px"><b>MYR 0</b> / yr</h5>
                        <p class="card-text mb-4">lorem ipsum<br>lorem ipsum<br>lorem ipsum<br>lorem ipsum<br>lorem ipsum</p>
                        <a href="#" class="btn btn-outline-dark btn-block" style="height: 50px;padding-top:11px">Sign-up for free</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-0 shadow">
                    <h5 class="card-header border-0">Member</h5>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size:30px"><b>MYR 300</b> / yr</h5>
                        <p class="card-text mb-4">lorem ipsum<br>lorem ipsum<br>lorem ipsum<br>lorem ipsum<br>lorem ipsum</p>
                        <a href="#" class="btn btn-warning btn-block" style="height: 50px;padding-top:11px">Get started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>