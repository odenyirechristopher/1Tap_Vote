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

// create voter
if($request == 1){
$first = mysqli_real_escape_string($conn,$_POST['firstname']);
$last = mysqli_real_escape_string($conn,$_POST['lastname']);
$sur = mysqli_real_escape_string($conn,$_POST['surname']);
$mail = mysqli_real_escape_string($conn,$_POST['email']);
$course = mysqli_real_escape_string($conn,$_POST['course_id']);
$gender = mysqli_real_escape_string($conn,$_POST['gender']);

    $duplicate=mysqli_query($conn,"SELECT * FROM Voter WHERE email='$mail'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo json_encode(array("statusCode"=>201,"message"=>"voter exist!"));
    } else {
        # code... 
        $sql = "INSERT INTO `Voter`(`firstname`,`lastname`,`surname`,`email`,`course_id`,`gender`) 
        VALUES('$first','$last','$sur','$mail','$course','$gender')";
        if (mysqli_query($conn,$sql)) {
            # code...
            echo json_encode(array("statusCode"=>200,"message"=>"Voter added!"));
        } else {
            # code...
            echo json_encode(array("statusCode"=>201,"message"=>"Error occured!"));
        }
        
    }
}
// read voter
function get_voter($conn){
$voter="SELECT v.voter_id,v.surname,v.lastname,v.gender,v.email,c.course_name FROM Voter as v JOIN course c on v.course_id = c.course_id";
    $result = $conn->query($voter);
    $no = 0;
    if ($result->num_rows > 0) {
        # code...
        while ($row = $result->fetch_assoc()) {
            $no ++;

            //gender
            if ($row['gender'] == 'Male') {
               $gender = '<p>Male</p>';
            } else {
                $gender = '<p>Female</p>';
            }
            
           echo '<tr>
<td>'.$no.'</td>
<td>'.$row['surname'].'</td>
<td>'.$row['lastname'].'</td>
<td>'.$gender.'</td>
<td>'.$row['email'].'</td>
<td>'.$row['course_name'].'</td>
<td>
<button type="button" class="badge badge-success btn-sm editbtn" data-toggle="modal" data-keyboard="false" 
data-backdrop="static" data-target="#docketModal" data-id='.$row['voter_id'].' data-name='.$row['surname'].'>Edit</button>
<button type="button" class="badge badge-danger btn-sm delete" data-id='.$row['voter_id'].'>Delete</button>
</td>
            </tr>';
        }
    } else {
        echo "0 results";
    }
}

// Fetch 
if($request == 2){
   $id = 0;

   if(isset($_POST['voter_id'])){
      $id = mysqli_escape_string($conn,$_POST['voter_id']);
   }

   $record = mysqli_query($conn,"SELECT v.voter_id,v.surname,v.firstname,v.lastname,v.gender,v.email,c.course_name,s.school_name FROM Voter as v JOIN course c on v.course_id = c.course_id JOIN school s ON c.school_id = s.school_id WHERE voter_id=".$id);

   $dataResult = array();

   if(mysqli_num_rows($record) > 0){
      $row = mysqli_fetch_assoc($record);
      $dataResult = array(
         "fname"=>$row['firstname'],
         "lname"=>$row['lastname'],
         "sname"=>$row['surname'],
         "email"=>$row['email'],
         "school"=>$row['school_name'],
         "course"=>$row['course_name'],
         "gender"=>$row['gender'],
      );

      echo json_encode( array("statusCode" => 200,"data" => $dataResult) );
      exit;
   }else{
      echo json_encode( array("statusCode" => 201) );
      exit;
   }
}


//update 
if($request == 3){
$id = 0;

   if(isset($_POST['voter_id'])){
      $id = mysqli_escape_string($conn,$_POST['voter_id']);
   }

   // Check id
   $record = mysqli_query($conn,"SELECT voter_id FROM Voter WHERE voter_id=".$id);
   if(mysqli_num_rows($record) > 0){

    $first = mysqli_real_escape_string($conn,trim($_POST['firstname']));
    $last = mysqli_real_escape_string($conn,trim($_POST['lastname']));
    $sur = mysqli_real_escape_string($conn,trim($_POST['surname']));
    $mail = mysqli_real_escape_string($conn,trim($_POST['email']));
    $course = mysqli_real_escape_string($conn,trim($_POST['course_id']));
    $gender = mysqli_real_escape_string($conn,trim($_POST['gender']));
 
   if( $first != '' && $last != "" && $sur != '' && $mail != '' && $course != '' && $gender != ''){

         mysqli_query($conn,"UPDATE Voter SET firstname='".$first."',lastname='".$last."',surname='".$sur."',
         email='".$mail."',course_id='".$course."',gender='".$gender."'  WHERE voter_id=".$id);

         echo json_encode( array("statusCode" => 200,"message" => "Record updated.") );
         exit;
      }else{
         echo json_encode( array("statusCode" => 201,"message" => "Please fill all fields.") );
         exit;
      }

   }
}

// delete voter
if($request == 4){
$id=mysqli_real_escape_string($conn,$_POST['voter_id']);
$query = "DELETE FROM Voter WHERE voter_id=$id";

if (mysqli_query($conn,$query)) {
    echo json_encode(array("statusCode"=>200));
} else {
  echo json_encode(array("statusCode"=>201));
}
}
// add avatar
if($request == 5){

}
//update avatar
if($request == 6){

}
//get course
if($request == 7){
$id = mysqli_real_escape_string($conn,$_POST['school_id']); 

$sql = "SELECT course_id,course_name FROM course WHERE school_id=".$id;

$result = mysqli_query($conn,$sql);

$course_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $courseid = $row['course_id'];
    $name = $row['course_name'];

    $course_arr[] = array("course_id" => $courseid, "course_name" => $name);
}

// encoding array to json format
echo json_encode($course_arr);
}
?>