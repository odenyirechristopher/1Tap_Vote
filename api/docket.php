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

// create docket
if($request == 1){
  $docket = mysqli_real_escape_string($conn,$_POST['docket_name']);
  $global = mysqli_real_escape_string($conn,$_POST['is_global']);
    $duplicate=mysqli_query($conn,"SELECT * FROM docket WHERE docket_name='$docket'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo json_encode(array("statusCode"=>201,"message"=>"docket exist!"));
    } else {
        # code... 
        $sql = "INSERT INTO `docket`(`docket_name`,`is_global`) VALUES('$docket','$global')";
        if (mysqli_query($conn,$sql)) {
            # code...
            echo json_encode(array("statusCode"=>200,"message"=>"Docket added!"));
        } else {
            # code...
            echo json_encode(array("statusCode"=>201,"message"=>"Error occured!"));
        }
        
    }
}
// read docket
function get_docket($conn){
$docket="SELECT * FROM docket";
    $result = $conn->query($docket);
    $no = 0;
    if ($result->num_rows > 0) {
        # code...
        while ($row = $result->fetch_assoc()) {
            $no ++;

            //badge
            if ($row['is_global'] == 1) {
               $status = '<p><span class="badge badge-success">Yes</span></p>';
            } else {
                $status = '<p><span class="badge badge-danger">No</span></p>';
            }

            //action change
            if ($row['is_global'] == 1) {
               $action = '<option value="2" class="badge-danger">Not</option>';
            } else {
                $action = '<option value="1" class="badge-success">Global</option>';
            }
            
            //getting Year from timestamp 
            $date = new DateTime($row['created_on']);
            $format=$date->format('Y-m-d');
            
           echo '<tr>
<td>'.$no.'</td>
<td>'.$row['docket_name'].'</td>
<td>'.$status.'</td>
<td>'.$format.'</td>
<td>
<select class="border-warning" onchange="docket_status(this.value,'.$row['docket_id'].')">
            <option selected="true" disabled="disabled">Choose..</option>
            '.$action.'
        </select>
</td>
<td>
<button type="button" class="badge badge-success btn-sm editbtn" data-toggle="modal" data-keyboard="false" 
data-backdrop="static" data-target="#docketModal" data-id='.$row['docket_id'].' data-name='.$row['docket_name'].'>Edit</button>
<button type="button" class="badge badge-danger btn-sm delete" data-id='.$row['docket_id'].'>Delete</button>
</td>
            </tr>';
        }
    } else {
        echo "0 results";
    }
}


//update docket
if($request == 3){

}
//delete docket
if($request == 4){
$id=mysqli_real_escape_string($conn,$_POST['docket_id']);
$query = "DELETE FROM docket WHERE docket_id=$id";

if (mysqli_query($conn,$query)) {
    echo json_encode(array("statusCode"=>200));
} else {
  echo json_encode(array("statusCode"=>201));
}


}

if($request== 5){
    $val=mysqli_real_escape_string($conn,$_POST['val']);
    $id=mysqli_real_escape_string($conn,$_POST['docket_id']);

    $query ="UPDATE `docket` set `is_global` = '".$val."'WHERE `docket_id`='".$id."'";

    if (mysqli_query($conn,$query)) {
        echo json_encode(array("statusCode"=>200));
    } else {
       echo json_encode(array("statusCode"=>201));
    }
}
?>