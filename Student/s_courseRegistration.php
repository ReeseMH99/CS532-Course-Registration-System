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
        <title>Student: Course Registration</title>
        <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3><?php echo $_SESSION['firstName'];?></h3>
    <h1>Course Registration</h1>
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

    <h2>Search by Major</h2>
    <form action="s_courseRegistration.php" method="post">
        <select name="option-selected">
            <option value="1">Computer Science</option>
            <option value="2">Biology</option>
            <option value="3">Statistics</option>
            <option value="4">Math</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    
    <div class = 'display'>
        <?php
            $majorSearch = $_POST['option-selected'];
            $select = "SELECT * FROM courses WHERE majorID = $majorSearch;";
            $result = mysqli_query($connection, $select);	
            echo "<table><tr><th>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<th><form action='s_registerCourse.php' method='post' target = 'blank'>
                    <button type='submit' formmethod = 'post' name = 'courseID' id='courseID' value='$row[0]'>Register</button>
                    </form></th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[1]</th>";
                echo "</tr>";
            }
            echo "</table>";
            
        
        ?>
    </div>


    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>