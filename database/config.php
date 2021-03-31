<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'emoshop';

//database connection
$conn = new mysqli($host,$user,$password,$database);

if ($conn == true) {
    # code...
    echo "$database";
} else {
    # code...
    echo "Something happened";
}

?>