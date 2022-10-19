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
        <title>Student: Course Grades</title>
        <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3><?php echo $_SESSION['firstName'];?></h3>
    <h1>Course Grades</h1>
    <hr>
    <div style="text-align:center">
        <a href="../studentHome.php" class = 'sub'>Home</a>
        <a href="./s_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./s_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./s_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./s_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./s_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>
    
    <h2>Grades by Semester</h2>
    <form action="s_courseGrades.php" method="post">
        <select name="option-selected">
            <option value="1">Spring 2022</option>
            <option value="2">Fall 2022</option>
            <option value="3">Spring 2023</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <div class = 'display'>
        <?php
        ?>
    </div>

    <h4>Print Reports</h4>

    <div>
        <ul>
            <li class = 'currcourse'>Print grade sheet</li>
        </ul> 
        <button type="submit">Grade Sheet</button>

    </div>

    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>