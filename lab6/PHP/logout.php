<?php
//Written by Oluwaferanmi Fawole
//start the session
session_start();
// unset all of the session variables
$_SESSION = array();

//destroy the session
session_destroy();

//Redirect the user to the login page
header("location: login.php");
exit;
?>