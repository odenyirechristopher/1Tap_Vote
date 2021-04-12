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

// create news
if($request == 1){
$event = mysqli_real_escape_string($conn,$_POST['event']);
  $date = mysqli_real_escape_string($conn,$_POST['date']);
  $venue = mysqli_real_escape_string($conn,$_POST['venue']);
    $duplicate=mysqli_query($conn,"SELECT * FROM news WHERE event='$event' AND date='$date'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo json_encode(array("statusCode"=>201,"message"=>"Event exist on that venue!"));
    } else {
        # code... 
        $sql = "INSERT INTO `news`(`date`,`event`,`venue`) VALUES('$date','$event','$venue')";
        if (mysqli_query($conn,$sql)) {
            # code...
            echo json_encode(array("statusCode"=>200,"message"=>"News added!"));
        } else {
            # code...
            echo json_encode(array("statusCode"=>201,"message"=>"Error occured!"));
        }
        
    }
}
// read news
function get_news($conn){
$news="SELECT * FROM news";
    $result = $conn->query($news);
    $no = 0;
    if ($result->num_rows > 0) {
        # code...
        while ($row = $result->fetch_assoc()) {
            $no ++;

              $curDate = date("Y-m-d");
            
            if ($curDate < $row['date']) {
                $status = '<p><span class="badge badge-success">Upcoming</span></p>';
            }elseif($curDate == $row['event_date']){
                $status = '<p><span class="badge badge-warning">Happening</span></p>';
            } else {
                $status = '<p><span class="badge badge-danger">Past event</span></p>';
            }
            
           echo '<tr>
<td>'.$no.'</td>
<td>'.$row['event'].'</td>
<td>'.$row['date'].'</td>
<td>'.$row['venue'].'</td>
<td>'.$status.'</td>
<td>
<button type="button" class="badge badge-success btn-sm editbtn" data-toggle="modal" data-keyboard="false" 
data-backdrop="static" data-target="#newsModal" data-id='.$row['event_id'].' data-name='.$row['event'].'>Edit</button>
<button type="button" class="badge badge-danger btn-sm delete" data-id='.$row['event_id'].'>Delete</button>
</td>
            </tr>';
        }
    } else {
        echo "0 results";
    }
}

// Fetch event details
if($request == 2){
   $id = 0;

   if(isset($_POST['event_id'])){
      $id = mysqli_escape_string($conn,$_POST['event_id']);
   }

   $record = mysqli_query($conn,"SELECT * FROM news WHERE event_id=".$id);

   $dataResult = array();

   if(mysqli_num_rows($record) > 0){
      $row = mysqli_fetch_assoc($record);
      $dataResult = array(
         "event"=>$row['event'],
         "venue"=>$row['venue'],
         "date"=>$row['date'],
      );

      echo json_encode( array("statusCode" => 200,"data" => $dataResult) );
      exit;
   }else{
      echo json_encode( array("statusCode" => 201) );
      exit;
   }
}


//update news
if($request == 3){
$id = 0;

   if(isset($_POST['event_id'])){
      $id = mysqli_escape_string($conn,$_POST['event_id']);
   }

   // Check id
   $record = mysqli_query($conn,"SELECT event_id FROM news WHERE event_id=".$id);
   if(mysqli_num_rows($record) > 0){
 
      $name = mysqli_escape_string($conn,trim($_POST['event']));
      $venue = mysqli_escape_string($conn,trim($_POST['venue']));
      $date = mysqli_escape_string($conn,$_POST['date']);

      if( $name != '' && $venue != '' && $date != '' ){

         mysqli_query($conn,"UPDATE news SET event='".$name."', date='".$date."' ,venue='".$venue."' WHERE event_id=".$id);

         echo json_encode( array("statusCode" => 200,"message" => "Record updated.") );
         exit;
      }else{
         echo json_encode( array("statusCode" => 201,"message" => "Please fill all fields.") );
         exit;
      }

   }
}
// delete news
if($request == 4){
    $id=mysqli_real_escape_string($conn,$_POST['event_id']);
$query = "DELETE FROM news WHERE event_id=$id";

if (mysqli_query($conn,$query)) {
    echo json_encode(array("statusCode"=>200));
} else {
  echo json_encode(array("statusCode"=>201));
}

}
?>