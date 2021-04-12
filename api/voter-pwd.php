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

// updating password
if($request == 1){
    
    $voterid=mysqli_real_escape_string($conn,$_POST['id']);
    $passwordhash=mysqli_real_escape_string($conn,$_POST['newPwd']);

    $result = mysqli_query($conn, "SELECT * FROM `Voter` WHERE voter_id='$voterid'");
    $row = mysqli_fetch_array($result);


    if (password_verify($_POST["currentPwd"],$row['password'])) {
        $new_pw = password_hash($passwordhash,PASSWORD_BCRYPT);
        mysqli_query($conn, "UPDATE `Voter` SET `password`='$new_pw' WHERE voter_id='$voterid'");
        echo json_encode(array("statusCode"=>200));
    } else{
       echo json_encode(array("statusCode"=>201));
       
    }
}
