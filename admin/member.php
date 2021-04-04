<?php

include('header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <?php include('sidenav.php'); ?>
        </div>
        <div class="col-sm-9 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-7">
                            <h3>Member Directory</h3>
                        </div>
                        <div class="col-sm-5">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" name="user" class="form-control" placeholder="Search : Email / IC / Name">
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-secondary" type="submit" name="search_user"><i class="fas fa-search"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['search_user'])) {
                        header("location: member.php");
                        echo '<table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $searchval = $_POST['user'];
                        $sql = "SELECT * FROM user where email='$searchval' or ic='$searchval' or name='$searchval'";
                        $result = $link->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row["id"];
                                $email = $row["email"];
                                $name = $row["name"];
                                $status = $row["status"];
                    ?>
                                <tr>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?php echo $id; ?>">View</a>&nbsp;&nbsp;<a href="postfunc/userunactivate.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm">Unactivate</a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '
                                    <tr>
                                        <td colspan="5">Not available!</td>
                                    </tr>
                                ';
                        }
                        ?>
                        </tbody>
                        </table>
                    <?php
                    } else {
                    ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if (isset($_GET['pageno'])) {
                                    $pageno = $_GET['pageno'];
                                } else {
                                    $pageno = 1;
                                }
                                $no_of_records_per_page = 10;
                                $offset = ($pageno - 1) * $no_of_records_per_page;

                                $total_pages_sql = "SELECT COUNT(*) FROM user";
                                $result = mysqli_query($link, $total_pages_sql);
                                $total_rows = mysqli_fetch_array($result)[0];
                                $total_pages = ceil($total_rows / $no_of_records_per_page);

                                $sql = "SELECT * FROM user LIMIT $offset, $no_of_records_per_page";
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row["id"];
                                        $email = $row["email"];
                                        $name = $row["name"];
                                        $status = $row["status"];
                                ?>
                                        <tr>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?php echo $id; ?>">View</a>&nbsp;&nbsp;<a href="postfunc/userunactivate.php?id=<?php echo $id ?>" class="btn btn-danger btn-sm">Unactivate</a></td>
                                        </tr>

                                <?php
                                    }
                                } else {
                                    echo '
                                    <tr>
                                        <td colspan="5">No registered member yet!</td>
                                    </tr>
                                ';
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    }
                    ?>


                    <br>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item <?php if ($pageno <= 1) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="?pageno=1">First</a>
                            </li>
                            <li class="page-item <?php if ($pageno <= 1) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                echo '#';
                                                            } else {
                                                                echo "?pageno=" . ($pageno - 1);
                                                            } ?>">
                                    < </a>
                            </li>
                            <li class="page-item <?php if ($pageno >= $total_pages) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                                echo '#';
                                                            } else {
                                                                echo "?pageno=" . ($pageno + 1);
                                                            } ?>"> > </a>
                            </li>
                            <li class="page-item <?php if ($pageno >= $total_pages) {
                                                        echo 'disabled';
                                                    } ?>">
                                <a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
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
</div>

<?php include('footer.php'); ?>