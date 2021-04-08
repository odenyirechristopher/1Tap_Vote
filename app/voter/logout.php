<?php
session_start();
session_destroy();
//Redirect tp login page
header("Location:./../../login.php");
?>