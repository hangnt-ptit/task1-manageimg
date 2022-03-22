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
    <title>Sign Up</title>
</head>

<body class="signup-body">
    <div class="container">
        <div class="row signup-area">
            <div class="col-sm-4 p-3 signup-area-1"></div>
            <div class="col-sm-4 p-3 signup-area-2">
                <form action="../controls/._php_signup.php" class="signup-form" id="form-2" method ="POST">
                    <div class="row signup-area-text">
                        <h5 class="signup-text">SIGN UP NOW</h5>
                    </div>
                    <!-- email  -->
                    <div class="mb-3 mt-3">
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        <span class="form-message"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="usn">
                        <span class="form-message"></span>
                    </div>
                    <!-- password -->
                    <div class="mb-3">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                        <span class="form-message"></span>
                    </div>
                    <!-- confirm password -->
                    <div class="mb-3">
                        <input type="password" class="form-control" id="cfr-pwd" placeholder="Confirm password" name="cfrpswd">
                        <span class="form-message"></span>
                    </div>
                    <!-- button signup -->
                    <button type="submit" name="submit" class="btn-signup">SIGN UP</button>
                    <!-- sign up -->
                    <div class="sign-up">
                        <label for="">Already have an account? <a href="html_login.php">Sign in</a></label>
                    </div>
                </form>
            </div>
            <div class="col-sm-4 p-3 login-area-3"></div>
        </div>
    </div>
    <script src="./js/validator.js"></script>

    <script>
        Validator({
            form: '#form-2',
            rules: [
                Validator.isRequired('#username'),
                Validator.isEmail('#email'),
                Validator.isPassword('#pwd', 6),
                Validator.isConfirmed('#cfr-pwd', function() {
                    return document.querySelector('#form-2 #pwd').value;
                }),
            ],
        });
    </script>
</body>

</html>