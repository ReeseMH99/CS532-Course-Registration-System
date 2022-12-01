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
        <title>Student: Course Grades</title>
        <link rel="stylesheet" href="./styleStudent.css">
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

    <h4 class = "headers" >Print Reports</h4>

    <div>
    <form action="s_courseGrades.php" method="post" name="test">
        <button type="submit">Grade Sheet</button>
    </form>
        <div class = 'display'>
        <?php

            $userID = $_SESSION['userID'];
            $select = "SELECT C.courseNumber, C.title, CS.dateTime, CS.location, SS.grade, SS.status, C.credits
                        FROM Courses C 
                        INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                        INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID 
                        WHERE SS.studentID = $userID";

            $result = mysqli_query($connection, $select);
            $count = mysqli_num_rows($result);

            echo "<table><tr>
            <th>Course Number</th>
            <th>Course Name</th>
            <th>Date and Time</th>
            <th>Location</th>
            <th>Grade</th>
            <th>Status</th>
            <th>Credits</th>
            </tr>";
            while($row = mysqli_fetch_array($result)){
                 
                echo "<tr>";
                echo "<th> $row[0]</th>";
                echo "<th> $row[1]</th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[3]</th>";
                echo "<th> $row[4]</th>";
                echo "<th> $row[5]</th>";
                echo "<th> $row[6]</th>";
                echo "</tr>";
            }
            $select2 = "SELECT SS.gradeVal
            FROM studentSchedule SS
            INNER JOIN  courseSchedule CS on CS.scheduleID = SS.scheduleID 
            WHERE SS.studentID = $userID
            AND SS.status = 'PASS' OR SS.status = 'FAIL'";
            $result2 = mysqli_query($connection, $select2);
            $count = mysqli_num_rows($result2);
            $sum = 0;
            while($row2 = mysqli_fetch_array($result2)){
                
                $sum += $row2['gradeVal'];
            }
            $gpa = $sum / $count;
            $gpa_formatted = number_format($gpa, 2);
            echo "<strong> Grade Point Average (GPA): $gpa_formatted</strong>";
            echo "</table>";
        ?>
        <?php
       
        ?>
        <?php
            $select3 = "SELECT C.credits
                        FROM Courses C
                        INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                        INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID 
                        WHERE SS.studentID = $userID
                        AND SS.status = 'PASS'";
            $result3 = mysqli_query($connection, $select3);
            $sumCredits = 0;
            $count2 = mysqli_num_rows($result3);
            while($row3 = mysqli_fetch_array($result3)){
                 
                $sumCredits += $row3['credits'];
            }
            echo "\r\n<strong> Number of Credits Earned: $sumCredits</strong>";
        ?>
    </div>
    

    </div>

    <form action="../logout.php" method="post">
        <button class = "logout" type="submit">Logout</button>
    </form>

</body>
</html>