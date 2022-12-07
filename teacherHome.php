<?php
session_start();
// studentHome.php

//if variable not set
if(!isset($_SESSION['userID'])){
	//send user to login/registration page
	header('location:login.html');
}
?>

<!DOCTYPE html> 
<html lang="en-us"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Teacher Home</title>
        <link rel="stylesheet" href="./Teacher/styleTeacher.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body >
    <!--Elements visible to users go here-->
    <h1 class = "studentName">Teacher Home</h1>
    <hr>
    <div style="text-align:center">
        <a href="./teacherHome.php"  style = "color: red" class = 'sub'>Home</a>
        <a href="./Teacher/t_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./Teacher/t_courseGrades.php" class = 'sub'>Course Grades</a>
        <!-- <a href="./Teacher/t_courseRegistration.php" class = 'sub'>Course Registration</a> -->
        <!-- <a href="./Teacher/t_majorRequirements.php" class = 'sub'>Major Requirements</a> -->
        <a href="./Teacher/t_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>

    <hr>
    </hr>
    <h2 style = "text-align:center;font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">Welcome <?php echo $_SESSION['username'];?></h2>
    <div> 
        <img src = "teacherHome.jpg" style = "width:800px;height:400px;display: block;margin-left: auto;margin-right: auto;"> 
    </div>

    <form action="logout.php" method="post">
        <button class ="logout" type="submit">Logout</button>
    </form>

</body>
</html>
