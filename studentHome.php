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

<style>
.studentTitle{
	font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
	color: rgb(175, 8, 8) ;
	font-size: xx-large;
	margin: 10px;
	padding: 10px;
}
.welcome{
    text-align: center;
	font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
	color: black ;
	font-size: xx-large;
	margin: 10px;
	padding: 10px;
}
.logout{
    background-color: rgb(175, 8, 8);
	color: rgb(249, 249, 250);
	border: 2px solid #837f7f;
	border-radius: 12px;
	font-size: large;
	font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
	padding: auto;
	width: 100px;
	text-align: center;
	text-decoration: dashed;
	margin: 10px;
	padding: 10px;
}
.studentBody{
   background-image: url("homepage.jpg");
background-size: fill;
}
.logout:hover{
    color: grey;
}


</style>
<html lang="en-us"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title >Student Home</title>
    <link rel="stylesheet" href="style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body class = "studentBody">
    <!--Elements visible to users go here-->
    <h1 class = "studentTitle">Student Home</h1>

    <hr>
    <div style="text-align:center">
        <a href="./studentHome.php"  style = "color: red" class = 'sub'>Home</a>
        <a href="./Student/s_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./Student/s_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./Student/s_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./Student/s_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./Student/s_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>

    <hr>
    </hr>
    <h2 class = "welcome" >Welcome <?php echo $_SESSION['firstName'];?></h2>


    <form action="logout.php" method="post">
        <button class ="logout" type="submit">Logout</button>
    </form>

</body>
</html>
