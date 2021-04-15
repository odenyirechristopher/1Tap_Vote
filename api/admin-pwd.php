<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = '1tapvote';

//database connection
$conn = new mysqli($host,$user,$password,$database);

$request = 0;
if(isset($_POST['request'])){
    $request = $_POST['request'];
}

   
    if (count($_POST) > 0) {
    $adminid=$_POST['id'];
    $passwordhash=mysqli_real_escape_string($conn,$_POST['newPwd']);

    $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_id='$adminid'");
    $row = mysqli_fetch_array($result);


    if (password_verify($_POST["currentPwd"],$row['password'])) {
        $new_pw = password_hash($passwordhash,PASSWORD_BCRYPT);
        mysqli_query($conn, "UPDATE `admin` SET `password`='$new_pw' WHERE admin_id='$adminid'");
        echo json_encode(array("statusCode"=>200));
    } else{
       echo json_encode(array("statusCode"=>201));  
    }
}

mysqli_close($conn);
?>