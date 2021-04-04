<?php

include('header.php');

$nid = null;
$eid = null;

?>

<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <?php include('sidenav.php'); ?>
        </div>
        <div class="col-sm-9">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-9">
                            <h3>Recent News</h3>
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#createnews"><i class="far fa-edit"></i>&nbsp;&nbsp;Post New News</a>
                            <!--create news Modal -->
                            <div id="createnews" class="modal fade" role="dialog">
                                <form method="post" action="activity.php" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" style="color: white;">Create News Post</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label" for="create_titlenews">News Title :</label>
                                                    <input type="text" class="form-control" id="create_titlenews" name="create_titlenews" placeholder="Title" required autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="create_content">Article :</label>
                                                    <textarea class="form-control" id="create_contentnews" name="create_contentnews" placeholder="Content" rows="5" required></textarea>
                                                </div>
                                                <label class="control-label" for="nimg1">Cover Image :</label><br>
                                                <input type="file" name="nimg1">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="create_news">Create Post</button>
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Post Date/Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id,title,content,timestamp FROM posts where category='news' order by timestamp desc limit 5";
                            $result = $link->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $nid = $row["id"];
                                    $titlenews = $row["title"];
                                    $contentnews = $row["content"];
                                    $timestampnews = $row["timestamp"];
                            ?>
                                    <tr>
                                        <td><?php echo $titlenews; ?></td>
                                        <td><?php echo $timestampnews; ?></td>
                                        <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?php echo $nid; ?>">Edit</a>&nbsp;&nbsp;<a href="postfunc/newsdelete.php?id=<?php echo $nid ?>" class="btn btn-danger btn-sm">Remove</a></td>
                                    </tr>
                                    <!--Edit Item Modal -->
                                    <div id="edit<?php echo $nid; ?>" class="modal fade" role="dialog">
                                        <form method="post" class="form-horizontal" role="form">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="color: white;">Edit News Post #<?php echo $nid; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="edit-id" value="<?php echo $nid; ?>">
                                                        <div class="form-group">
                                                            <label class="control-label" for="edit_titlenews">News Title :</label>
                                                            <input type="text" class="form-control" id="edit_titlenews" name="edit_titlenews" value="<?php echo $titlenews; ?>" placeholder="Title" required autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="edit_content">Article :</label>
                                                            <textarea class="form-control" id="edit_contentnews" name="edit_contentnews" placeholder="Content" rows="5" required><?php echo $contentnews; ?></textarea>
                                                        </div>
                                                        <i class="text-muted">* If you want to edit uploaded image, please remove the post and make the new post.</i>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="update_news">Edit</button>
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            <?php
                                }
                            } else {
                                echo '
                                    <tr>
                                        <td colspan="3">No news post yet</td>
                                    </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-9">
                            <h3>Recent Active Events</h3>
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#createevent"><i class="far fa-edit"></i>&nbsp;&nbsp;Post New Event</a>
                            <!--create events Modal -->
                            <div id="createevent" class="modal fade" role="dialog">
                                <form method="post" action="activity.php" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" style="color: white;">Create Event Post</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label" for="create_titleevent">Event Title :</label>
                                                    <input type="text" class="form-control" id="create_titleevent" name="create_titleevent" placeholder="Title" required autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="create_content">Article :</label>
                                                    <textarea class="form-control" id="create_contentevent" name="create_contentevent" placeholder="Content" rows="5" required></textarea>
                                                </div>
                                                <label class="control-label" for="eimg1">Cover Image :</label><br>
                                                <input type="file" name="eimg1">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="create_event">Create Post</button>
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Post Date/Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id,title,content,timestamp FROM posts where category='events' order by timestamp desc limit 5";
                            $result = $link->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $eid = $row["id"];
                                    $titleevent = $row["title"];
                                    $contentevent = $row["content"];
                                    $timestampevent = $row["timestamp"];
                            ?>
                                    <tr>
                                        <td><?php echo $titleevent; ?></td>
                                        <td><?php echo $timestampevent; ?></td>
                                        <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?php echo $eid; ?>">Edit</a>&nbsp;&nbsp;<a href="postfunc/eventsdelete.php?id=<?php echo $eid ?>" class="btn btn-danger btn-sm">Remove</a></td>
                                    </tr>
                                    <!--Edit Item Modal -->
                                    <div id="edit<?php echo $eid; ?>" class="modal fade" role="dialog">
                                        <form method="post" class="form-horizontal" role="form">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" style="color: white;">Edit Event Post #<?php echo $eid; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="edit-id" value="<?php echo $eid; ?>">
                                                        <div class="form-group">
                                                            <label class="control-label" for="edit_titleevent">News Title :</label>
                                                            <input type="text" class="form-control" id="edit_titleevent" name="edit_titleevent" value="<?php echo $titleevent; ?>" placeholder="Title" required autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="edit_contentevent">Article :</label>
                                                            <textarea class="form-control" id="edit_contentevent" name="edit_contentevent" placeholder="Content" rows="5" required><?php echo $contentevent; ?></textarea>
                                                        </div>
                                                        <i class="text-muted">* If you want to edit uploaded image, please remove the post and make the new post.</i>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="update_event">Edit</button>
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            <?php
                                }
                            } else {
                                echo '
                                    <tr>
                                        <td colspan="3">No active event post yet</td>
                                    </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

// Update news
if (isset($_POST['update_news'])) {
    $edit_ntitle = $_POST['edit_titlenews'];
    $edit_ncontent = $_POST['edit_contentnews'];
    $sql = "UPDATE posts SET title='$edit_ntitle',content='$edit_ncontent' WHERE id='$nid' ";
    if ($link->query($sql) === TRUE) {
        echo '<script>window.location.href="activity.php"</script>';
    } else {
        echo "Error updating record: " . $link->error;
    }
}

// Update events
if (isset($_POST['update_event'])) {
    $edit_etitle = $_POST['edit_titleevent'];
    $edit_econtent = $_POST['edit_contentevent'];
    $sql = "UPDATE posts SET title='$edit_etitle',content='$edit_econtent' WHERE id='$eid' ";
    if ($link->query($sql) === TRUE) {
        echo '<script>window.location.href="activity.php"</script>';
    } else {
        echo "Error updating record: " . $link->error;
    }
}

// create news
if (isset($_POST['create_news'])) {

    $create_ntitle = mysqli_real_escape_string($link, $_POST['create_titlenews']);
    $create_ncontent = mysqli_real_escape_string($link, $_POST['create_contentnews']);
    $create_nimg = $create_ntitle .'_'. $_FILES['nimg1']['name'];
    $target = "../img/post_img/" . basename($create_nimg);
    $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo '<script>window.alert("Please select image type file only : jpg, jpeg, gif, png");</script>';
    } else {
        $sql = "INSERT INTO posts (title, content, author, category, img_one) VALUES ('$create_ntitle', '$create_ncontent','webmaster','news','$create_nimg')";
        mysqli_query($link, $sql);
        if (move_uploaded_file($_FILES['nimg1']['tmp_name'], $target)) {
            echo '<script>window.alert("Post success");</script>';
            echo '<script>window.location.href="activity.php"</script>';
        } else {
            echo '<script>window.alert("Post failed to publish!");</script>';
            echo '<script>window.location.href="activity.php"</script>';
        }
    }
}

// create event
if (isset($_POST['create_event'])) {

    $create_etitle = mysqli_real_escape_string($link, $_POST['create_titleevent']);
    $create_econtent = mysqli_real_escape_string($link, $_POST['create_contentevent']);
    $create_eimg = $create_etitle .'_'. $_FILES['eimg1']['name'];
    $target = "../img/post_img/" . basename($create_eimg);
    $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo '<script>window.alert("Please select image type file only : jpg, jpeg, gif, png");</script>';
    } else {
        $sql = "INSERT INTO posts (title, content, author, category, img_one) VALUES ('$create_etitle', '$create_econtent','webmaster','events','$create_eimg')";
        mysqli_query($link, $sql);
        if (move_uploaded_file($_FILES['eimg1']['tmp_name'], $target)) {
            echo '<script>window.alert("Post success");</script>';
            echo '<script>window.location.href="activity.php"</script>';
        } else {
            echo '<script>window.alert("Post failed to publish!");</script>';
            echo '<script>window.location.href="activity.php"</script>';
        }
    }
}

include('footer.php');

?>