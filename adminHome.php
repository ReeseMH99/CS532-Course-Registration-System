<?php
session_start();
// adminHome.php

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
    



    <h3>Insert Course</h3>
    <form action="adminHome.php" method="post">
        <div>
            <label >id</label>
            <input type="text" name="id" required>
        </div>
        <div>
            <label>title</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Course Number</label>
            <input type="text" name="courseNumber" required>
        </div>
        <div>
            <label>Major ID</label>
            <input type="text" name="majorID" required>
        </div>
        <div>
            <label>bool</label>
            <input type="text" name="requiredBool" required>
        </div>
        <div>
            <label>credits</label>
            <input type="text" name="credits" required>
        </div>

		<input type="submit" name = "submit" value = "Submit">
	</form>	

    <?php
    
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $courseNumber = $_POST['courseNumber'];
        $majorID = $_POST['majorID'];
        $requiredBool = $_POST['requiredBool'];
        $credits = $_POST['credits'];

        $result = mysqli_query($connection, "INSERT INTO courses (id, title, courseNumber, majorID, requiredBool, credits) VALUES ('$id', '$title', '$courseNumber', '$majorID', '$requiredBool', '$credits')");

        if($result){
            echo "Success";
        }else{
            echo "Fail";
        }
    }
        
        //$sql = "INSERT INTO courses VALUES ('$id', '$title', '$courseNumber', '$majorID', '$requiredBool', '$credits')";
    ?>


    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>