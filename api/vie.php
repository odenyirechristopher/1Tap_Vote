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