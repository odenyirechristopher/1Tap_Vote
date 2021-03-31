<?php
	include ("./../database/config.php");
	session_start();
	// admin register
	if($_POST['type']==1){
		$firstname=mysqli_real_escape_string($db,$_POST['firstname']);
        $lastname=mysqli_real_escape_string($db,$_POST['lastname']);
        $phone_no=mysqli_real_escape_string($db,$_POST['phone_no']);
        $email=mysqli_real_escape_string($db,$_POST['email']);
        $password=mysqli_real_escape_string($db,$_POST['password']);
        // Password hash
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
	
		$duplicate=mysqli_query($db,"select * from admin where email='$email'");
		if (mysqli_num_rows($duplicate)>0)
		{
			echo json_encode(array("statusCode"=>201));
		}
		else{
			$sql = "INSERT INTO `admin`(`firstname`, `lastname`, `email`, `phone_no`, `pass_word`,`is_active`,`is_super`,`date_time`) 
			VALUES ('$firstname','$lastname','$email','$phone_no','$password_hash','0','0', now())";
			if (mysqli_query($db, $sql)) {
				echo json_encode(array("statusCode"=>200));
			} 
			else {
				echo json_encode(array("statusCode"=>201));
			}
		}
		mysqli_close($db);
	}


	//admin test 2
	if($_POST['type']==2){
        if($stmt = $db->prepare("SELECT admin_id,firstname,lastname,phone_no,pass_word,is_active,is_super FROM admin WHERE email = ? AND  is_super = '1'")){
			$stmt->bind_param('s',$_POST['email']);
			$stmt->execute();
	        $stmt->bind_result($admin_id,$firstname,$lastname,$phone_no,$pass_word,$is_active,$is_super);
			
			if ($stmt->fetch() && password_verify($_POST['password'],$pass_word)){
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['sadname'] = $firstname;
				$_SESSION['email']=$_POST['email'];
				$_SESSION['sadid'] = $admin_id;
				echo json_encode(array("statusCode"=>202));

			}
			else if($stmt = $db->prepare("SELECT admin_id,firstname,lastname,phone_no,pass_word,is_active,is_super FROM admin WHERE email = ? AND is_super = '0'")){
				$stmt->bind_param('s',$_POST['email']);
			    $stmt->execute();
	            $stmt->bind_result($admin_id,$firstname,$lastname,$phone_no,$pass_word,$is_active,$is_super);


				if($stmt->fetch() && password_verify($_POST['password'],$pass_word)){
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['adname'] = $firstname;
				$_SESSION['email']=$_POST['email'];
				$_SESSION['adid'] = $admin_id;
				echo json_encode(array("statusCode"=>200));
				
			    }
			     else{
				echo json_encode(array("void.."));
			    }
			}
            //  else{
			// 	echo json_encode(array("The specific user doesn't exist on the system!!"));
			//     }
			 		
		}	
		$stmt->close();

		 }

 ?>