<?php
session_start();


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
        <title>Teacher: Faculty Course Information</title>
        <link rel="stylesheet" href="style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3>Teacher</h3>
    <h1>Faculty Course Information</h1>
    <hr>
    <div style="text-align:center">
        <a href="../teacherHome.php" class = 'sub'>Home</a>
        <a href="./t_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./t_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./t_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./t_majorRequirements.php" class = 'sub'>Major Requirements</a>
    </div>
    </hr>
    <hr>
    

    

    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>