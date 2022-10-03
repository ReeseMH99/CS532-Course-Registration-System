<?php
// logout.php
//terminates sesssion when user clicks logout

session_start();
session_destroy();	// destroy current session
// redirect user back to login/registration page
header('location:login.html');

?>
