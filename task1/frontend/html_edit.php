<?php
ob_start();
session_start();
if (!isset($_SESSION["login"])) {
    header("location: html_login.php");
}
include '../controls/z_connectdb.php';
include '../controls/._php_img.php';

if (!isset($_SESSION["login"])) {
    header("location: html_login.php");
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/e8f697cee1.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/validator.js"></script>
    <title>Edit Image</title>
</head>

<body class="page-body-edit">
    <header>
        <div class="container-fluid">
            <div style="background-color: #f5f5f5" class="row">
                <div class="col-sm-3 p-3 page-name">
                    <h3>Manage Your Images,<h5 class="user-name">
                            <?php
                            if (isset($_SESSION['login'])) {
                                echo $_SESSION['login'][0][2];
                            }
                            ?>!
                        </h5>
                    </h3>
                </div>
                <div class="col-sm-8 p-3 page-menu">
                    <ul style="list-style-type: none">
                        <li class="list-menu">

                            <!-- button them moi anh -->
                            <button class="btn-newphoto" id="newphoto">New Photo</button>

                            <form style="display: inline" method="POST">
                                <input name="search" class="search-form" type="text" placeholder="Search..." value="<?php if (isset($_GET['search'])) {
                                                                                                                        echo $_GET['search'];
                                                                                                                    } ?>">
                                <button name="search-img" class="btn-search" type="submit"><i class="fa fa-search"></i></button>
                                <button name="all-img" style="width: 50px; display: inline" class="btn-newphoto">All</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-1 p-3 logout">
                    <a href="../controls/._php_logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </header>

    <section>
            <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Album</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $album = countImage();
                            foreach ($album as $key => $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['album'] ?></td>
                                    <td><?php echo $row['COUNT(id_img)'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-9">
                    <form action="../controls/._php_delete.php" method="POST">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 200px">Image</th>
                                    <th>Tilte</th>
                                    <th style="width: 150px">Albums</th>
                                    <th>Description</th>
                                    <th style="width: 150px">Time</th>
                                </tr>
                            </thead>

                            <!-- lay du lieu bang tu database -->
                            <tbody>
                                <?php
                                if (isset($_POST['search-img'])) {
                                    $img = searchImage();
                                } else {
                                    $img = getImage();
                                }
                                foreach ($img as $key => $row) {
                                ?>
                                    <tr>
                                        <td><?php echo "<img src='../uploads/" . $row['image'] . "' alt='image' style='width:100px;height:80px;display:block'>"; ?>

                                            <form method="GET">
                                                <!-- link xóa 1 ảnh -->
                                                <a class="link-delete" onclick="return confirm('Are you sure to delete this image?')" href="../controls/._php_del1img.php?id=<?php echo $row['id_img']; ?>">Delete</a>

                                                <!-- link sửa 1 ảnh -->
                                                <a id="editphoto" class="link-edit" href="html_edit.php?id=<?php echo $row['id_img']; ?>">Edit</a>

                                                <!-- link download 1 ảnh -->
                                                <a class="link-download" href="../controls/._php_download.php?file=<?php echo $row['image'] ?>">Download</a>
                                            </form>
                                        </td>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><?php echo $row['album'] ?></td>
                                        <td><?php echo $row['description'] ?></td>
                                        <td><?php echo $row['time'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            </div>
    </section>

    <?php
    $img = get_image_to_edit($_GET['id']);
    $id = $img['id_img'];
    $url = '../uploads/' . $img['image'];
    ?>

    <!-- form chỉnh sửa ảnh -->
    <form action="../controls/._php_editimg.php?id=<?php echo "$id" ?>" method="POST" enctype="multipart/form-data" class="popup-editphoto">
        <div class="popup-content">
            <img class="img-edit-close" src="../img/close.png" alt="close">
            <div class="popup-title">
                <img src="../img/cat1.jpg" alt="cat">
                <h5>EDIT YOUR IMAGE HERE</h5>
            </div>

            <table class="table table-bordered popup-table">
                <thead>

                </thead>

                <tbody>
                    <tr>
                        <td style="height: 100px"><Label>Image: </Label></td>
                        <td></span><img style="width:100px;height:80px" src="<?php echo "$url" ?>" alt="photo"></td>
                    </tr>
                    <tr>
                        <td><Label>Title: </Label></td>
                        <?php echo "<td><input type = text name = title value =\"" . $img['title'] . "\" ></td>"; ?>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <?php echo "<td><input type = text name = category value =\"" . $img['album'] . "\" ></td>"; ?>
                    </tr>
                    <tr>
                        <td><Label>Description: </Label></td>
                        <?php echo "<td><textarea name = description rows=\"2\" cols=\"42\">" . $img['description'] . "</textarea></td>"; ?>
                    </tr>

                </tbody>
            </table>
            <button type="submit" name="save" value="edit" class="btn-newphoto">SAVE</button>
        </div>
    </form>

    <script type="text/javascript">
        // js cho button new photo
        document.getElementById("editphoto").addEventListener("click", function() {
            document.querySelector(".popup-editphoto").style.display = "flex";
            document.querySelector(".page-body-edit").style.position = "relative";
        })

        // js cho button tat popup
        document.querySelector(".img-edit-close").addEventListener("click", function() {
            document.querySelector(".popup-editphoto").style.display = "none";
            window.location.href = "html_index.php";
        })
    </script>


</body>

</html>