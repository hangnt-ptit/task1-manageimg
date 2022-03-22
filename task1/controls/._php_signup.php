<?php
include 'z_connectdb.php';

if(isset($_POST['submit']) && $_POST["email"] != '' && $_POST["usn"] != '' && $_POST["pswd"] != '' && $_POST["cfrpswd"] != ''){
    $email = $_POST["email"];
    $usn = $_POST["usn"];
    $pswd = $_POST["pswd"];
    $cfrpswd = $_POST["cfrpswd"];

    // that bai neu password != confirm password
    if($pswd != $cfrpswd){
        header("location:../frontendhtml_signup.php");
    }

    // kiem tra xem trong csdl co ton tai tai khoan chua

    $sql = $conn->prepare("SELECT * from user where email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $old_user= $sql->get_result()->fetch_all();

    $pswd = md5($pswd);
    if(count($old_user) > 0){
        header("location:../frontend/html_signup.php");
    }
    else{
        // them moi user vao db
    $sql = $conn->prepare("INSERT INTO user (email, username, password) VALUES (?,?,?)");
    $sql->bind_param("sss", $email, $usn, $pswd);
    $sql->execute();

    // thong bao dang ky thanh cong
    $alert="<script>alert('Successful!');</script>";
	echo $alert;  
    header("location:../frontend/html_login.php");
    }
}

else{
    header("location:../frontend/html_signup.php");
}
?>