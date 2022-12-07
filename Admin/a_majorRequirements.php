<?php
session_start();
// studentHome.php
$connection = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($connection, 'CourseRegDB2');
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
        <title>Admin: Major Requirements</title>
        <link rel="stylesheet" href="./styleAdmin.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3 class = "studentName">Admin: <?php echo $_SESSION['firstName'];?></h3>
    <h1 class = "headers" >Major Requirements</h1>
    <hr>
    <div style="text-align:center">
        <a href="../adminHome.php"  class = 'sub'>Home</a>
        <a href="./a_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./a_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./a_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./a_majorRequirements.php"  style = "color: red" class = 'sub'>Major Requirements</a>
        <!-- <a href="./a_facultyCourse.php" class = 'sub'>Faculty Course Information</a> -->
    </div>
    </hr>
    <hr>
    
    <h1 class = "headers">Add Major Requirements Here</h1>
    

    <form action="../logout.php" method="post">
        <button class = "logout" type="submit">Logout</button>
    </form>

</body>
</html>