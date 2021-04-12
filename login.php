<!DOCTYPE html>
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
                <div class="alert alert-success alert-dismissible" id="success" style="display: none">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                </div>
                <div class="alert alert-danger alert-dismissible" id="error" style="display: none">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                </div>
                <form class="" action="" method="post" id="login_form">
                    <h2 class="text-center"><span class="text-warning"><sup>1</sup><sub>Tap</sub></span>Vote</h2>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email.." required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password.." required>
                    </div>
                    <button type="submit" class="btn btn-block btn-success mt-1" id="btnlogin">Login</button>
                    <br>
                    <a href="forgot-password.php">Forgot password?</a>

                </form>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $("#btnlogin").on("click", function() {
            var email = $("#email").val().trim();
            var pass = $("#password").val().trim();

            // console.log(email,pass);
            if (email!="" && pass!="") {
                $.ajax({
                    url:"./api/account.php",
                    type:"post",
                    data:{
                        request:2,
                        email:email,
                        password:pass,
                    },
                    cache:false,
                    success:function(dataResult){
                        console.log(dataResult);
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            location.href = "./app/voter/index.php"; 
                        } else {
                            $("#error").show();
                            $("#error").html("Invalid credentials or Suspended account !").delay(3000).fadeOut(3000);
                            $("#login_form")[0].reset();
                        }
                    }

                });
            } else {
                $("#error").show();
                $("#error").html("Please fill all the field !").delay(3000).fadeOut(3000);
            }

        });
    });
    </script>
</body>

</html>