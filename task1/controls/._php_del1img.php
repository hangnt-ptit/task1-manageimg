<?php
ob_start();
session_start();
include 'z_connectdb.php';

    $id_user = mysqli_real_escape_string($conn, $_SESSION['login'][0][0]);
    
    $id_img = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = $conn->prepare("DELETE FROM img where id_user = ? 
        and id_img = ? ");
    $sql->bind_param("ss", $id_user, $id_img);
    $sql->execute();
    header("location: ../frontend/html_index.php");
