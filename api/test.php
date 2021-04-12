<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = '1tapvote';

//database connection
$conn = new mysqli($host,$user,$password,$database);

// $request = 2;
// if(isset($_POST['request'])){
//     $request = $_POST['request'];
// }
session_start();
$_FILES['photo']['name']='steve.png';
$_FILES['photo']['tmp_name']='steve.png';
	//voter login
 $valid_extensions = array('jpeg','jpg','png');
    $path ='./../uploads/';
    if(!empty($_SESSION['id']) || !empty($_POST['docket']) || $_FILES['photo']){
        $img = $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];

        $ext = strtolower(pathinfo($img,PATHINFO_EXTENSION));

        $final_image = $img;

        if (in_array($ext,$valid_extensions)) {
            $path = $path.strtolower($final_image);

            if(move_uploaded_file($tmp,$path)){
            //   $voter = mysqli_real_escape_string($conn,$_POST['id']);
            //   $docket = mysqli_real_escape_string($conn,$_POST['docket']);
            $voter = 8;
              $docket = 6;
              $duplicate=mysqli_query($conn,"SELECT * FROM candidate WHERE voter_id='$voter'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo json_encode(array("statusCode"=>201,"message"=>"Candidate exist!"));
    } else {
        # code... 
        $sql = "INSERT INTO `candidate`(`voter_id`,`docket_id`) VALUES('$voter','$docket')";
        $photo ="UPDATE `Voter` SET `photo`='$final_image' WHERE Voter_id = $voter";
        if (mysqli_query($conn,$sql)) {
            # code...
            echo json_encode(array("statusCode"=>200,"message"=>"candidate added!"));
        } else {
            # code...
            echo json_encode(array("statusCode"=>201,"message"=>"Error occured!"));
        }
        //photo upload
        if (mysqli_query($conn,$photo)) {
            # code...
            echo json_encode(array("statusCode"=>200,"message"=>"Photo added!"));
        } else {
            # code...
            echo json_encode(array("statusCode"=>201,"message"=>"Error occured!"));
        }
        
    }
            }
        }
    }

 ?>