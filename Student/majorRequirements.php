<?php
session_start();
// studentHome.php

//if variable not set
if(!isset($_SESSION['username'])){
	//send user to login/registration page
	header('location:login.html');
}
?>

<!DOCTYPE html> 
<html lang="en-us"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student: Major Requirements</title>
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3>Student</h3>
    <h1>Major Requirements</h1>
    <hr>
    

    

    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>