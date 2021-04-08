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

// update voter
if($request == 3){

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