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

$userID = $_SESSION['userID'];


?>

<!DOCTYPE html> 
<html lang="en-us"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student: Course Registration</title>
        <link rel="stylesheet" href="./styleStudent.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3 class = "studentName"><?php echo $_SESSION['firstName'];?></h3>
    <h1 class = "headers">Course Registration</h1>
    <hr>
    <div style="text-align:center">
        <a href="../studentHome.php" class = 'sub'>Home</a>
        <a href="./s_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./s_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./s_courseRegistration.php"  style = "color: red" class = 'sub'>Course Registration</a>
        <a href="./s_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./s_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>

    <h2 class = "headers" >Search by Major</h2>
    <form action="s_courseRegistration.php" method="post">
        <select name="option-selected">
            <option value="1">Computer Science</option>
            <option value="2">Biology</option>
            <option value="3">Statistics</option>
            <option value="4">Math</option>
        </select>
        <button style="margin-bottom: 15px" type="submit">Submit</button>
    </form>
    
    <div class = 'display'>
        <?php
            $majorSearch = $_POST['option-selected'];
            //$select = "SELECT * FROM courses WHERE majorID = $majorSearch";
            $select = "SELECT C.id, C.courseNumber, C.title, T.title, U.firstName, U.lastName, CS.dateTime, CS.location, CS.totalNumSeats 
                        FROM Courses C 
                        INNER JOIN courseSchedule CS on CS.courseID = C.id
                        INNER JOIN teachers T on T.teacherID = CS.teacherID
                        INNER JOIN users U on U.userID = T.teacherID
                        WHERE C.majorID = $majorSearch
                        AND CS.semester = 'SP23'";
            $result = mysqli_query($connection, $select);

            echo "<table><tr><th>"; 
            $flag = true;
            while($row = mysqli_fetch_array($result)){
                while($flag){

                    echo "<tr>
                    <th>Course Number</th>
                    <th>Course Name</th>
                    <th>Professor</th>
                    <th>Date and Time</th>
                    <th>Location</th>
                    <th>Seats</th>
                    </tr>";
                    $flag = false;
                }
                echo "<tr>";
                echo "<th> $row[1]</th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[3] $row[4] $row[5]</th>";
                echo "<th> $row[6]</th>";
                echo "<th> $row[7]</th>";
                echo "<th> $row[8]</th>";
                echo "<th><form action='s_registerCourse.php' method='post' target = 'blank'>
                    <button type='submit' formmethod = 'post' name = 'courseID' id='courseID' value='$row[0]'>Register</button>
                    </form></th>"; 
                // echo "<th>$row[2]</th>";
                // echo "<th>$row[1]</th>";

                echo "</tr>";
                
            }
            echo "</table>";  

        ?>
    </div>

    <form action="../logout.php" method="post">
        <button class = "logout" type="submit">Logout</button>
    </form>

</body>
</html>