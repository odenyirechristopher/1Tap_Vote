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

// update course
if($request == 3){

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