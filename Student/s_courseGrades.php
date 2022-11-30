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
<style>
.headers{
    color: rgb(0, 0, 0);
	font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
	font-size: x-large;
	margin: 10px;
	padding: 10px; 
}
.studentName{
    color: rgb(175, 8, 8);
	font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
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
.logout:hover{
    color: grey;
}

</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student: Course Grades</title>
        <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3 class = "studentName"><?php echo $_SESSION['firstName'];?></h3>
    <h1 class ="headers">Course Grades</h1>
    <hr>
    <div style="text-align:center">
        <a href="../studentHome.php" class = 'sub'>Home</a>
        <a href="./s_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./s_courseGrades.php" style = "color: red" class = 'sub'>Course Grades</a>
        <a href="./s_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./s_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./s_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>
    
    <h2 class = "headers" >Grades by Semester</h2>
    <form action="s_courseGrades.php" method="post">
        <select name="option-selected">
            <option value="SP22">Spring 2022</option>
            <option value="FA22">Fall 2022</option>
            <option value="SP23">Spring 2023</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <div class = 'display'>
        <?php
            $userID = $_SESSION['userID'];
            $semester = $_POST['option-selected'];

            $select = "SELECT C.courseNumber, C.title, CS.dateTime, CS.location, SS.grade, SS.status 
                        FROM Courses C 
                        INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                        INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID 
                        WHERE SS.studentID = $userID 
                        AND CS.semester = '$semester'";

            $result = mysqli_query($connection, $select);
            $count = mysqli_num_rows($result);
            echo "<strong> $semester </strong>";
            echo "<table><tr>";
            $flag = true;
            while($row = mysqli_fetch_array($result)){
               
                while($flag){
                    echo "<th>Course Number</th>
                    <th>Course Name</th>
                    <th>Date and Time</th>
                    <th>Location</th>
                    <th>Grade</th>
                    <th>Status</th>
                    </tr>";
                    $flag = false;
                }
               
                echo "<tr>";
                echo "<th> $row[0]</th>";
                echo "<th> $row[1]</th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[3]</th>";
                echo "<th> $row[4]</th>";
                echo "<th> $row[5]</th>";
                echo "</tr>";
            }
            echo "</table>";

            function fullReport(){
                $userID = $_SESSION['userID'];

              $connection = new mysqli($servername,$userID,$password,$database);

              $sql = "SELECT * FROM studentschedule";
              $result = $connection->query($sql);
              $flag = true;
                while($row = mysqli_fetch_array($result)){
              
                  while($flag){
                    echo "<th>Course Number</th>
                    <th>Course Name</th>
                    <th>Date and Time</th>
                    <th>Location</th>
                    <th>Grade</th>
                    <th>Status</th>
                    </tr>";
                    $flag = false;
               }
              
                echo "<tr>";
                echo "<th> $row[0]</th>";
                echo "<th> $row[1]</th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[3]</th>";
                echo "<th> $row[4]</th>";
                echo "<th> $row[5]</th>";
                echo "</tr>";
           }
              echo "</table>";
           
           
           
                
            }
            
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
        <button style= "margin-bottom: 20px" type="submit">Logout</button>
    </form>

</body>
</html>