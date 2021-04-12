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

// create course
if($request == 1){
 $school = mysqli_real_escape_string($conn,$_POST['school_id']);
 $course = mysqli_real_escape_string($conn,$_POST['course_name']);
    $duplicate=mysqli_query($conn,"SELECT * FROM course WHERE course_name='$course' AND school_id='$school'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo json_encode(array("statusCode"=>201,"message"=>"Course exist!"));
    } else {
        # code... 
        $sql = "INSERT INTO `course`(`school_id`,`course_name`) VALUES('$school','$course')";
        if (mysqli_query($conn,$sql)) {
            # code...
            echo json_encode(array("statusCode"=>200,"message"=>"Course added!"));
        } else {
            # code...
            echo json_encode(array("statusCode"=>201,"message"=>"Error occured!"));
        }
        
    }
}
// read course
function get_course($conn){
$course="SELECT c.course_id,c.course_name,s.school_name FROM course c JOIN school s on c.school_id = s.school_id";
    $result = $conn->query($course);
    $no = 0;
    if ($result->num_rows > 0) {
        # code...
        while ($row = $result->fetch_assoc()) {
            $no ++;
           echo '<tr>
<td>'.$no.'</td>
<td>'.$row['course_name'].'</td>
<td>'.$row['school_name'].'</td>
<td>
<button type="button" class="badge badge-success btn-sm editbtn" data-toggle="modal" data-keyboard="false" 
data-backdrop="static" data-target="#schoolModal" data-id='.$row['course_id'].' data-name='.$row['course_name'].'>Edit</button>
<button type="button" class="badge badge-danger btn-sm delete" data-id='.$row['course_id'].'>Delete</button>
</td>
            </tr>';
        }
    } else {
        echo "0 results";
    }
}

// Fetch course details
if($request == 2){
   $id = 0;

   if(isset($_POST['course_id'])){
      $id = mysqli_escape_string($conn,$_POST['course_id']);
   }

   $record = mysqli_query($conn,"SELECT c.course_name,c.course_id,s.school_name FROM course c JOIN school s ON c.school_id = s.school_id WHERE course_id=".$id);

   $response = array();

   if(mysqli_num_rows($record) > 0){
      $row = mysqli_fetch_assoc($record);
      $dataResult = array(
         "school_name"=>$row['school_name'],
         "course_name"=>$row['course_name'],
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

   if(isset($_POST['course_id'])){
      $id = mysqli_escape_string($conn,$_POST['course_id']);
   }

   // Check id
   $record = mysqli_query($conn,"SELECT course_id FROM course WHERE course_id=".$id);
   if(mysqli_num_rows($record) > 0){
 
      $name = mysqli_escape_string($conn,trim($_POST['course_name']));
      $school = mysqli_escape_string($conn,trim($_POST['school_id']));

      if( $name != '' && $school != "" ){

         mysqli_query($conn,"UPDATE course SET course_name='".$name."',school_id='".$school."' WHERE course_id=".$id);

         echo json_encode( array("statusCode" => 200,"message" => "Record updated.") );
         exit;
      }else{
         echo json_encode( array("statusCode" => 201,"message" => "Please fill all fields.") );
         exit;
      }

   }
}
// delete course
if($request == 4){
$id=mysqli_real_escape_string($conn,$_POST['course_id']);
$query = "DELETE FROM course WHERE course_id=$id";

if (mysqli_query($conn,$query)) {
    echo json_encode(array("statusCode"=>200));
} else {
  echo json_encode(array("statusCode"=>201));
}
}
?>