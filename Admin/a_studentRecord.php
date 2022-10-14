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
    <title>Admin: Student Record</title>
    <link rel="stylesheet" href="style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3>Admin</h3>
    <h1>Student Record</h1>
    <hr>
    <div style="text-align:center">
        <a href="../adminHome.php" class = 'sub'>Home</a>
        <a href="./a_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./a_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./a_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./a_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>

    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>
