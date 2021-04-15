<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = '1tapvote';

//database connection
$conn = new mysqli($host,$user,$password,$database);

session_start();
$valid_extensions = array('jpeg', 'jpg', 'png'); 
$path = './../uploads/'; 

if(!empty($_POST['id']) && !empty($_POST['docket']))
{
$img = $_FILES['picture']['name']; 
$tmp = $_FILES['picture']['tmp_name']; 

$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

$final_image = rand(1000,1000000).$img;

// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 

if(move_uploaded_file($tmp,$path)){


          $voter=mysqli_real_escape_string($conn,$_POST['id']);
          $docket = mysqli_real_escape_string($conn,$_POST['docket']);
	
	      $duplicate=mysqli_query($conn,"SELECT * FROM candidate WHERE voter_id='$voter'");
	  if (mysqli_num_rows($duplicate)>0){
		echo json_encode(array("statusCode"=>201,"message"=>"Candidate exist!"));
	  }
	else {
        $sql = "INSERT INTO `candidate`(`voter_id`,`docket_id`) VALUES('".$voter."','".$docket."')";
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

        //check if successfully added
        if (json_encode(array("statusCode"=>200))) {
            # code...
            echo "<script>
                    alert('Data inserted');
                     window.location.href = './../app/voter/vie.php';
                    </script>";
        } else {
            # code...
            echo "<h4>Something happenened!</h4>";
        }
        
  }
   }
  }  
}
mysqli_close($conn);

 ?>