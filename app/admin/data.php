<?php
header('Content-Type: application/json');
$host = 'localhost';
$user = 'root';
$password = '';
$database = '1tapvote';

//database connection
$conn = new mysqli($host,$user,$password,$database);

// $docket = $_GET['id'];
// var_dump($docket);
$docket = 8;
$sqlQuery = "SELECT count('vo.vote_id') as votetally,v.firstname
FROM vote vo 
JOIN candidate c ON vo.candidate_id = c.candidate_id 
JOIN docket d ON c.docket_id = d.docket_id 
JOIN Voter v ON vo.voter_id = v.voter_id 
WHERE d.docket_id= $docket GROUP BY vo.candidate_id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>