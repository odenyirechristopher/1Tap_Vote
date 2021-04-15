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

// create candidate
if($request == 1){

}
// read candidate
function get_candidate($conn){
$candidate="SELECT c.candidate_id,c.status,v.firstname,v.lastname,v.surname,v.gender,v.photo,d.docket_name FROM candidate c JOIN Voter v on c.voter_id = v.voter_id JOIN docket d on c.docket_id = d.docket_id ORDER BY candidate_id DESC";
    $result = $conn->query($candidate);
    $no = 0;
    if ($result->num_rows > 0) {
        # code...
        while ($row = $result->fetch_assoc()) {
            $no ++;
            if ($row['status'] == 2) {
                $status = '<p><span class="badge badge-success">Approved</span></p>';
            } elseif($row['status'] == 0) {
             $status = '<p><span class="badge badge-warning">Pending</span></p>';
            } else {
             $status = '<p><span class="badge badge-danger">Rejected</span></p>';
            }

           echo '<tr>
<td>'.$no.'</td>
<td><img src="./../../uploads/'.$row['photo'].'" class="photo"  alt="" height="30px" width="50px"></td>
<td>'.$row['surname'].'</td>
<td>'.$row['firstname'].'</td>
<td>'.$row['lastname'].'</td>
<td>'.$row['gender'].'</td>
<td>'.$row['docket_name'].'</td>
<td>'.$status.'</td>
<td>
<select class="border-warning" onchange="candidate_status(this.value,'.$row['candidate_id'].')">
            <option selected="true" disabled="disabled">Choose..</option>
            <option value="1" class="bg-danger">Rejected</option>
            <option value="2" class="bg-success">Approved</option>
            <option value="0" class="bg-warning">Pending</option>

        </select>
<button type="button" class="badge badge-danger btn-sm delete" data-id='.$row['candidate_id'].'>Delete</button>
</td>
            </tr>';
        }
    } else {
        echo "0 results";
    }
}

// update candidate
if($request == 3){

}
// delete candidate
if($request == 4){
$id=mysqli_real_escape_string($conn,$_POST['candidate_id']);
$query = "DELETE FROM candidate WHERE candidate_id=$id";

if (mysqli_query($conn,$query)) {
    echo json_encode(array("statusCode"=>200));
} else {
  echo json_encode(array("statusCode"=>201));
}
}

//candidate application status
if($request == 5){
$val=mysqli_real_escape_string($conn,$_POST['val']);
$id=mysqli_real_escape_string($conn,$_POST['candidate_id']);

    $query ="UPDATE `candidate` set `status` = '".$val."'WHERE `candidate_id`='".$id."'";

    if (mysqli_query($conn,$query)) {
        echo json_encode(array("statusCode"=>200));
    } else {
       echo json_encode(array("statusCode"=>201));
    }
}
?>