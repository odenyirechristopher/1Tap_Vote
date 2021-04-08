<?php
require("./../database/config.php");
$id=2;
// $id=mysql_real_escape_string($conn,$_POST['school_id']);
$query = "DELETE FROM school WHERE school_id=$id";

if (mysqli_query($conn,$query)) {
    echo json_encode(array("statusCode"=>200));
} else {
  echo json_encode(array("statusCode"=>201));
}
?>