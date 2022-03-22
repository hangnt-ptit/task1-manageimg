<?php
ob_start();
session_start();
include 'z_connectdb.php';

    if(isset($_POST['save'])){

        $id_user = $_SESSION['login'][0][0];
        $id_img = $_GET['id'];

        $img_title = $_POST['title'];
        $img_album = $_POST['category'];
        $img_description = $_POST['description'];
        $img_time = gmdate("Y-m-d H:i:s");
    
        $sql = $conn->prepare("UPDATE img 
                SET    title = ?,
                       album  = ?,
                       description = ?,
                       time = ?
                WHERE  id_user = ?
                and    id_img = ?");
        $sql->bind_param("ssssss", $img_title, $img_album, $img_description, $img_time, $id_user, $id_img);
        $sql->execute();
        header("location: ../frontend/html_index.php");
    }