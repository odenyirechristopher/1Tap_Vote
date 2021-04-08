<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Grab user data from the database 
if ( isset( $_SESSION['id'] ) ) {
} else {
    // Redirect them to the login page
    header("Location: ./../../login.php");
}
?>