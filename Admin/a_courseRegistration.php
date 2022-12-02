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
        <title>Admin: Course Registration</title>
        <link rel="stylesheet" href="./styleAdmin.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3 class = "studentName">Admin</h3>
    <h1 class = "headers">Course Registration</h1>
    <hr>
    <div style="text-align:center">
        <a href="../adminHome.php" class = 'sub'>Home</a>
        <a href="./a_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./a_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./a_courseRegistration.php"  style = "color: red" class = 'sub'>Course Registration</a>
        <a href="./a_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./a_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>
    
    <h3 class="headers">Insert Course</h3>
    <form action="a_courseRegistration.php" method="post">
        <div>
            <label >Course Id</label>
            <input style="margin-bottom: 5px" type="text" name="id" required>
        </div>
        <div>
            <label>Title</label>
            <input style="margin-bottom: 5px" type="text" name="title" required>
        </div>
        <div>
            <label>Course Number</label>
            <input style="margin-bottom: 5px" type="text" name="courseNumber" required>
        </div>
        <div>
            <label>Major ID</label>
            <input style="margin-bottom: 5px" type="text" name="majorID" required>
        </div>
        <div>
            <label>Requirement</label>
            <input style="margin-bottom: 5px" type="text" name="requiredBool" required>
        </div>
        <div>
            <label>Credits</label>
            <input style="margin-bottom: 5px" type="text" name="credits" required>
        </div>

		<input style="margin-bottom: 5px"type="submit" name = "submit" value = "Submit">
	</form>	

    <?php

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $courseNumber = $_POST['courseNumber'];
        $majorID = $_POST['majorID'];
        $requiredBool = $_POST['requiredBool'];
        $credits = $_POST['credits'];

        $result = mysqli_query($connection, "INSERT INTO courses 
        (id, title, courseNumber, majorID, requiredBool, credits)
        VALUES 
        ('$id', '$title', '$courseNumber', '$majorID', '$requiredBool', '$credits')");
        
        if($result) {
            echo "Added course successfully";
        }else {
            echo "Failed to add course";
        }
    }
    ?>

    

    <form action="../logout.php" method="post">
        <button class = "logout" type="submit">Logout</button>
    </form>

</body>
</html>