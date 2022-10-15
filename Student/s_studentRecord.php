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
    <title>Student: Student Record</title>
    <link rel="stylesheet" href="style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3>Student</h3>
    <h1>Student Record</h1>
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


    <?php
        $select = "SELECT $userID FROM Users WHERE userID = '$userID';";
        $result = mysqli_query($connection, $select);	
        $array = mysqli_fetch_array($result);
        $firstName = $array[0];
    ?>

    <h2>Personal Information</h2>
    <div>
        <ul>
            <li class = 'info'>Name: <?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></li>
            <li class = 'info'>StudentID: <?php echo $_SESSION['userID']; ?></li>
            <li class = 'info'>Email: <?php echo $_SESSION['email']; ?></li>
            <li class = 'info'>Phone Number: <?php echo $_SESSION['phone']; ?></li>
            <li class = 'info'>DoB: <?php echo $_SESSION['doB']; ?></li>
            <li class = 'info'>Major: </li>
            <li class = 'info'>Minor:</li>
        </ul> 

    </div>

    <h2>Current Courses</h2>

    <h2>Past Courses</h2>

    <h4>Print Report</h4>


    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>
