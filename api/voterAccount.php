<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = '1tapvote';

//database connection
$conn = new mysqli($host,$user,$password,$database);

if(!empty($_POST['email']) && !empty($_POST['password']))
{
if($stmt = $conn->prepare("SELECT voter_id,firstname,lastname,surname,password,gender,photo,course_id FROM Voter WHERE email = ?")){
		$stmt->bind_param('s',$_POST['email']);
		$stmt->execute();
	    $stmt->bind_result($voter_id,$firstname,$lastname,$surname,$password,$gender,$photo,$course_id);
			
		if ($stmt->fetch() && password_verify($_POST['password'],$password)){
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
		    $_SESSION['fname'] = $firstname;
			$_SESSION['lname'] = $lastname;
			$_SESSION['sname'] = $surname;
			$_SESSION['gender'] = $gender;
			$_SESSION['course'] = $course_id;
			$_SESSION['photo'] = $photo;
			$_SESSION['email']=$_POST['email'];
			$_SESSION['id'] = $voter_id;
			header('Location: ./app/voter/index.php');
			exit;
		}
         else{
			$error_message = "Incorrect Email Address or Password.";
			// exit;
		 }
		 		
		}	
		$stmt->close();
}

?>