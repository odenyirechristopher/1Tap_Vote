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


// vote candidate
if($request== 1){
$candidate = mysqli_real_escape_string($conn,$_POST['candidate_id']);
$voter = mysqli_real_escape_string($conn,$_POST['voter_id']);
        # code... 
        $sql = "INSERT INTO `vote`(`voter_id`,`candidate_id`) VALUES('$voter','$candidate')";
        if (mysqli_query($conn,$sql)) {
            # code...
            echo json_encode(array("statusCode"=>200,"message"=>"Voted!"));
            exit;
        } else {
            # code...
            echo json_encode(array("statusCode"=>201,"message"=>"Error occured!"));
            exit;
        }
        mysql_close($conn);

    }


$docket = $_GET['id'];
$result=$conn->query("SELECT c.candidate_id,c.status,v.firstname,v.lastname,v.surname,v.gender,v.photo,d.docket_name FROM candidate c JOIN Voter v on c.voter_id = v.voter_id JOIN docket d on c.docket_id = d.docket_id WHERE c.docket_id='$docket' AND status='2'");
if ($result->num_rows > 0) {
    while($row=$result->fetch_assoc()){
         echo '<tr>
         <td><img src="./../../uploads/'.$row['photo'].'" class="photo"  alt="" height="40px" width="80px"></td>
         <td>'.$row['firstname'].'</td>
        <td>'.$row['lastname'].'</td>
        <td><input type="radio" class="form-check-input" name="vote" data-id='.$row['candidate_id'].'></td>

         </tr>';
    }
 } else {
    echo '<p class="text-center text-danger">No candidate</p>';
}


?>