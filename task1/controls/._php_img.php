<?php

// hàm lấy tất cả dữ liệu về ảnh rồi show ra bảng
function getImage()
{
    include 'z_connectdb.php';
    $selectimg = array();

    $id_user = mysqli_real_escape_string($conn, $_SESSION['login'][0][0]);

    $sql = $conn->prepare("SELECT * FROM img where id_user = ?");
    $sql->bind_param("s", $id_user);
    $sql->execute();
    
    $selectimg = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    return $selectimg;
}

// hàm lấy dữ liệu về ảnh thông qua search box

function searchImage()
{
    include 'z_connectdb.php';
    $selectimg = array();

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $id_user = mysqli_real_escape_string($conn, $_SESSION['login'][0][0]);
        $keyword = mysqli_real_escape_string($conn, $_POST['search']);

        $sql = $conn->prepare("SELECT * FROM img where id_user = ?
                and album = ?
                or title = ?
                or description = ?
                or time = ?");
        $sql->bind_param("sssss", $id_user, ...[$keyword,$keyword,$keyword,$keyword]);
        $sql->execute();
        $selectimg = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $selectimg;
    }
}

// hàm lấy số lượng img có trong album

function countImage()
{
    include 'z_connectdb.php';
    $selectimg = array();

    $id_user = mysqli_real_escape_string($conn,$_SESSION['login'][0][0]);

    $sql = $conn->prepare("SELECT COUNT(id_img), album
    FROM img 
    where id_user = ?
    group by album");

    $sql->bind_param("s", $id_user);
    $sql->execute();
    $selectimg = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    return $selectimg;
}
// hàm lấy ra ảnh cần edit

function get_image_to_edit($id)
{
    include 'z_connectdb.php';

    $id_user = mysqli_real_escape_string($conn,$_SESSION['login'][0][0]);

    $sql = $conn->prepare("SELECT * FROM img where id_user = ? 
    and id_img = ?");

    $sql->bind_param("ss", $id_user, $id);
    $sql->execute();

    $selectimg = $sql->get_result()->fetch_array(MYSQLI_ASSOC);
    return $selectimg;
}
