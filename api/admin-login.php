<?php
if(isset($_POST['email']) && isset($_POST['password'])){
if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))){

$user_email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));
$query = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$user_email'");

if(mysqli_num_rows($query) > 0){

$row = mysqli_fetch_assoc($query);
$user_db_pass = $row['password'];

// VERIFY PASSWORD
$check_password = password_verify($_POST['password'], $user_db_pass);

if($check_password === TRUE){

session_regenerate_id(true);

$_SESSION['email'] = $user_email;  
header('Location: ./app/admin/index.php');
exit;

}
else{
// INCORRECT PASSWORD
$error_message = "Incorrect Email Address or Password.";

}

}
else{
// EMAIL NOT REGISTERED
$error_message = "Incorrect Email Address or Password.";
}

}
else{

// IF FIELDS ARE EMPTY
$error_message = "Please fill in all the required fields.";
}

}
?>