<?php
ob_start();
session_start();
include 'z_connectdb.php';

if(isset($_POST['submit']) && isset($_FILES['my_img'])){

    $img_name = $_FILES['my_img']['name'];
    $img_tmpname = $_FILES['my_img']['tmp_name'];
    $img_error = $_FILES['my_img']['error'];
    $img_size = $_FILES['my_img']['size'];

    if($img_error === 0){
        if($img_size > 680000){
            $em = "Your file is too large!";
            header("location: ../frontend/html_index.php?error=$em");
        }
        else{
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if(in_array( $img_ex_lc, $allowed_exs)){
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../uploads/'.$new_img_name;

                move_uploaded_file( $img_tmpname, $img_upload_path);

                // lay du lieu tu form
                $id_user = $_SESSION['login'][0][0];
                $title = $_POST['title'];
                $category = $_POST['category'];
                $description = $_POST['description'];
                $time = date("Y-m-d H:i:s");  
                
                // truy van den csdl
                $sql = $conn->prepare("INSERT INTO img (id_user, image, title, description, album, time) VALUES (?,?,?,?,?,?)");
                $sql->bind_param("ssssss", $id_user, $new_img_name, $title, $description, $category, $time);
                $sql->execute();
                header("location: ../frontend/html_index.php");
                
            }
            else{
                $em = "Can't upload files of this type.";
                header("location: ../frontend/html_index.php?error=$em");
            }
        }
    }
    else{
        $em = "Unknown error occurred.";
        header("location: ../frontend/html_index.php?error=$em");
    }
}
else{
    header("location: ../frontend/html_index.php");
}
?>