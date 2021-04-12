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

if($request == 1){
    $school = mysqli_real_escape_string($conn,$_POST['school_name']);
    $duplicate=mysqli_query($conn,"SELECT * FROM school WHERE school_name='$school'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo json_encode(array("statusCode"=>201,"message"=>"School exist!"));
    } else {
        # code... 
        $sql = "INSERT INTO `school`(`school_name`) VALUES('$school')";
        if (mysqli_query($conn,$sql)) {
            # code...
            echo json_encode(array("statusCode"=>200,"message"=>"School added!"));
        } else {
            # code...
            echo json_encode(array("statusCode"=>201,"message"=>"Error occured!"));
        }
        
    }
    
// mysqli_close($conn);
}
// read school
function get_school($conn){
$school="SELECT * FROM school";
    $result = $conn->query($school);
    $no = 0;
    if ($result->num_rows > 0) {
        # code...
        while ($row = $result->fetch_assoc()) {
            $no ++;
           echo '<tr>
<td>'.$no.'</td>
<td>'.$row['school_name'].'</td>
<td>
<button type="button" class="badge badge-success btn-sm editbtn" data-toggle="modal" data-keyboard="false" 
data-backdrop="static" data-target="#schoolModal" data-id='.$row['school_id'].' data-name='.$row['school_name'].'>Edit</button>
<button type="button" class="badge badge-danger btn-sm delete" data-id='.$row['school_id'].'>Delete</button>
</td>
            </tr>';
        }
    } else {
        echo "0 results";
    }
}

// Fetch School details
if($request == 2){
   $id = 0;

   if(isset($_POST['school_id'])){
      $id = mysqli_escape_string($conn,$_POST['school_id']);
   }

   $record = mysqli_query($conn,"SELECT * FROM school WHERE school_id=".$id);

   $dataResult = array();

   if(mysqli_num_rows($record) > 0){
      $row = mysqli_fetch_assoc($record);
      $dataResult = array(
         "school_name"=>$row['school_name'],
      );

      echo json_encode( array("statusCode" => 200,"data" => $dataResult) );
      exit;
   }else{
      echo json_encode( array("statusCode" => 201) );
      exit;
   }
}


//update school
if($request == 3){
$id = 0;

   if(isset($_POST['school_id'])){
      $id = mysqli_escape_string($conn,$_POST['school_id']);
   }

   // Check id
   $record = mysqli_query($conn,"SELECT school_id FROM school WHERE school_id=".$id);
   if(mysqli_num_rows($record) > 0){
 
      $name = mysqli_escape_string($conn,trim($_POST['school_name']));

      if( $name != '' ){

         mysqli_query($conn,"UPDATE school SET school_name='".$name."' WHERE school_id=".$id);

         echo json_encode( array("statusCode" => 200,"message" => "Record updated.") );
         exit;
      }else{
         echo json_encode( array("statusCode" => 201,"message" => "Please fill all fields.") );
         exit;
      }

   }
}
//delete school
if($request == 4){
$id=mysqli_real_escape_string($conn,$_POST['school_id']);
$query = "DELETE FROM school WHERE school_id=$id";

if (mysqli_query($conn,$query)) {
    echo json_encode(array("statusCode"=>200));
} else {
  echo json_encode(array("statusCode"=>201));
}

}
?>