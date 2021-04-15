<?php
session_start();
require './database/config.php';
require './api/adminAccount.php';
?>
<html class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/custom.css" />
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/popper.min.js"></script>
</head>

<body class="h-100">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8c col-lg-6">
                                  <?php
if(isset($success_message)){
echo '<div class="alert alert-success alert-dismissible" id="success">'.$success_message.'</div>'; 
}
if(isset($error_message)){
echo '<div class="alert alert-danger alert-dismissible" id="success" >'.$error_message.'</div>'; 
}
?>
                <form class="" action="" method="post" id="login_form">
                    <h2 class="text-center"><span class="text-warning"><sup>1</sup><sub>Tap</sub></span>Vote</h2>
                    <h6 class="text-center text-info"><i>Admin Account</i></h6>
                    <h6 class="text-center">
                    <a href="./index.php" class="btn-danger">Home</a>
                    </h6>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Enter your email.." required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter password.." required>
                    </div>
                    <button type="submit" class="btn btn-block btn-success mt-1" id="btnlogin">Login</button>
                    <br>
                    <a href="forgot-password.php">Forgot password?</a>
  

                </form>
            </div>
        </div>
    </div>
</body>

</html>