<?php
require("./../../database/config.php");
$request = 0;



// create news
if($request == 1){

}
// read news
function get_global_docket($conn){
    $docket="SELECT * FROM docket";
    $result = $conn->query($docket);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value='.$row['docket_id'].'>'.$row['docket_name'].'</option>';
        }
    } else {
        echo "0 results";
    }
    
}

// update news
if($request == 3){

}
// delete news
if($request == 4){

}

get_global_docket($conn);
?>