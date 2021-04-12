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

// create vie
if($request == 1){

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
            //   $voter = mysqli_real_escape_string($_SESSION['id']);
              $voter=8;
              $docket = mysqli_real_escape_string($conn,$_POST['docket']);
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

}
// read vie
if($request== 2){
 $sql = "SELECT docket_id,docket_name FROM docket";

$result = mysqli_query($conn,$sql);

$docket_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $docketid = $row['docket_id'];
    $name = $row['docket_name'];

    $docket_arr[] = array("docket_id" => $docketid, "docket_name" => $name);
}

// encoding array to json format
echo json_encode($docket_arr);
}

// update vie
if($request == 3){

}
// delete vie
if($request == 4){

}

?>