<?php
session_start();
// adminHome.php

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
        <title>Admin Home</title>
        <link rel="stylesheet" href="style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h1>Admin Home</h1>
    <hr>
    <div style="text-align:center">
        <a href="./Admin/a_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./Admin/a_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./Admin/a_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./Admin/a_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./Admin/a_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>

    <hr>
    </hr>
    <h2>Welcome <?php echo $_SESSION['username'];?></h2>
    
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>
