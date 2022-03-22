<!-- include php file -->
<?php
ob_start();
session_start();
include '../controls/z_connectdb.php';

if (isset($_POST['submit']) && $_POST["email"] != '' && $_POST["pswd"] != '') {
    $email = $_POST["email"];
    $pswd = md5($_POST["pswd"]);

    $sql = $conn->prepare("SELECT * from user where email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $data = $sql->get_result()->fetch_all();

    if(count($data) && $data[0][3] === $pswd){
        $_SESSION['login'] = $data;
        header("location:html_index.php");
    }
    else{
        echo '<script> alert "Username or Password incorrect!"</script>';
        header("location: html_login.php");
    }

    // $sql = "SELECT * from user where email = '$email'";
    // $email_available = mysqli_query($conn, $sql);
    // $data = mysqli_fetch_row($email_available);
    // if (count($data)) {
    //     $_SESSION['login'] = $data;
    //     header("location:html_index.php");
    // } else echo "Password Incorrect.";
}
?>
<!-- frontend design -->
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
    <title>LOGIN</title>
</head>

<body class="login-body">
    <div class="container">
        <div class="row login-area">
            <div class="col-sm-4 p-3 login-area-1"></div>
            <div class="col-sm-4 p-3 login-area-2">
                <form method="POST" class="login-form" id="form-1">
                    <div class="row login-area-text">
                        <h5 class="login-text">YOUR IMAGES</h5>
                    </div>
                    <!-- username  -->
                    <div class="mb-3 mt-3 form-group">
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        <span class="form-message"></span>
                    </div>
                    <!-- password -->
                    <div class="mb-3 form-group">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                        <span class="form-message"></span>
                    </div>
                    <!-- button login -->
                    <button name="submit" type="submit" class="btn-login">LET ME IN</button>
                    <!-- sign up -->
                    <div class="sign-up">
                        <a href="html_signup.php">Create an account?</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-4 p-3 login-area-3"></div>
    </div>
    </div>
    <script src="./js/validator.js"></script>

    <!-- js dang nhap -->
    <script language="javascript">
        Validator({
            form: '#form-1',
            rules: [
                Validator.isRequired('#pwd'),
                Validator.isEmail('#email')
            ]
        });
    </script>"
</body>

</html>