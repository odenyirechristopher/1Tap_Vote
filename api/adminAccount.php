<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = '1tapvote';

//database connection
$conn = new mysqli($host,$user,$password,$database);

if(!empty($_POST['email']) && !empty($_POST['password']))
{
if($stmt = $conn->prepare("SELECT admin_id,firstname,lastname,password,email,photo FROM admin WHERE email = ?")){
		$stmt->bind_param('s',$_POST['email']);
		$stmt->execute();
	    $stmt->bind_result($admin_id,$firstname,$lastname,$password,$email,$photo);
			
		if ($stmt->fetch() && password_verify($_POST['password'],$password)){
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
		    $_SESSION['fname'] = $firstname;
			$_SESSION['lname'] = $lastname;
			$_SESSION['email'] = $email;
			$_SESSION['photo'] = $photo;
			$_SESSION['email']=$_POST['email'];
			$_SESSION['adid'] = $admin_id;
			header('Location: ./app/admin/index.php');
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