<?php

include('header.php');

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
                                <form method="post" class="form-horizontal" role="form">
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
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload Image</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                    </div>
                                                </div>
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
                                        <td colspan="3">No active event post yet</td>
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
                            <a href="#" class="btn btn-outline-info btn-block"><i class="far fa-edit"></i>&nbsp;&nbsp;Post New Event</a>
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
                                        <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?php echo $eid; ?>">Edit</a>&nbsp;&nbsp;<a href="postfunc/newsdelete.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm">Remove</a></td>
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
$target_dir = "../img/post_img";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST['create_news'])) {

    $edit_ntitle = $_POST['create_titlenews'];
    $edit_ncontent = $_POST['create_contentnews'];

    // check img
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

include('footer.php');

?>