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
    <title>Student: Student Record</title>
    <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3><?php echo $_SESSION['firstName'];?></h3>
    <h1>Student Record</h1>
    <hr>
    <div style="text-align:center">
        <a href="../studentHome.php" class = 'sub'>Home</a>
        <a href="./s_studentRecord.php"  style = "color: red" class = 'sub'>Student Record</a>
        <a href="./s_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./s_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./s_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./s_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>


    <?php

        $userID = $_SESSION['userID'];

        $select = "SELECT title FROM Majors M INNER JOIN Students S ON M.id=S.majorID WHERE S.studentID = $userID;";
        $result = mysqli_query($connection, $select);	
        $array = mysqli_fetch_array($result);
        $major = $array[0];

        $select = "SELECT title FROM Majors M INNER JOIN Students S ON M.id=S.minorID WHERE S.studentID = $userID;";
        $result = mysqli_query($connection, $select);	
        $array = mysqli_fetch_array($result);
        $minor = $array[0];

    ?>

    <h2>Personal Information</h2>
    <div>
        <ul>
            <li class = 'info'><strong>Name:</strong> <?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></li>
            <li class = 'info'><strong>StudentID:</strong> <?php echo $_SESSION['userID']; ?></li>
            <li class = 'info'><strong>Email:</strong> <?php echo $_SESSION['email']; ?></li>
            <li class = 'info'><strong>Phone Number:</strong> <?php echo $_SESSION['phone']; ?></li>
            <li class = 'info'><strong>DoB:</strong> <?php echo $_SESSION['doB']; ?></li>
            <li class = 'info'><strong>Major:</strong> <?php echo $major ?></li>
            <li class = 'info'><strong>Minor:</strong> <?php echo $minor ?></li>
        </ul> 

    </div>

    <h2>Current Courses</h2>
    
    <div class = 'display'>
        <?php
            $userID = $_SESSION['userID'];

            $select = "SELECT C.courseNumber, C.title, CS.dateTime, CS.location, SS.status 
                        FROM Courses C 
                        INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                        INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID 
                        WHERE SS.studentID = $userID 
                        AND CS.semester = 'FA22'";

            $result = mysqli_query($connection, $select);
            $count = mysqli_num_rows($result);
            
            echo "<table><tr>
            <th>Course Number</th>
            <th>Course Name</th>
            <th>Date and Time</th>
            <th>Location</th>
            <th>Status</th>
            </tr>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<th> $row[0]</th>";
                echo "<th> $row[1]</th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[3]</th>";
                echo "<th> $row[4]</th>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </div>

    <h2>Past Courses</h2>

    <div class = 'display'>
        <?php
            $userID = $_SESSION['userID'];

            $select = "SELECT C.courseNumber, C.title, CS.dateTime, CS.location, SS.grade, SS.status 
                        FROM Courses C 
                        INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                        INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID 
                        WHERE SS.studentID = $userID
                        AND CS.semester = 'SP22'";

            $result = mysqli_query($connection, $select);
            $count = mysqli_num_rows($result);
            
            echo "<table><tr>
            <th>Course Number</th>
            <th>Course Name</th>
            <th>Date and Time</th>
            <th>Location</th>
            <th>Grade</th>
            <th>Status</th>
            </tr>";
            while($row = mysqli_fetch_array($result)){
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
        ?>
    </div>

    <h2>Future Courses</h2>

    <div class = 'display'>
        <?php
            //echo "Test";
            $userID = $_SESSION['userID'];
            //echo "\n $userID";
            


            $select = "SELECT C.courseNumber, C.title, CS.dateTime, CS.location, SS.status, CS.scheduleID 
                        FROM Courses C 
                        INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                        INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID 
                        WHERE SS.studentID = $userID
                        AND CS.semester = 'SP23'";

            $result = mysqli_query($connection, $select);
            $count = mysqli_num_rows($result);

            echo "<table><tr>
            <th>Course Number</th>
            <th>Course Name</th>
            <th>Date and Time</th>
            <th>Location</th>
            <th>Status</th>
            </tr>";
            while($row = mysqli_fetch_array($result)){
                 
                echo "<tr>";
                echo "<th> $row[0]</th>";
                echo "<th> $row[1]</th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[3]</th>";
                echo "<th> $row[4]</th>";
                echo "<th> $row[5]</th>";
                echo "<th><form action='s_studentRecord.php' method='post'>
                <button type='submit' formmethod = 'post' name = 'scheduleID' id='scheduleID' value='$row[5]'>Drop</button>
                </form></th>";
                echo "</tr>";
            }
            echo "</table>";

            $scheduleID = $_POST['scheduleID'];
            $semesterEnrolled = 'SP23';

            //echo "$courseID";
            if(isset($_POST['scheduleID'])){
                // echo "$courseID";
                
                // $select = "SELECT C.courseNumber, C.title
                //         FROM Courses C 
                //         INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                //         INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID";                $result = mysqli_query($connection, $select);
                // $array = mysqli_fetch_array($result);
                // echo "$array[0]";
                // echo "$array[1]";
            
                $query = "DELETE FROM studentschedule WHERE studentID = '$userID' AND scheduleID = '$scheduleID'";    
                if(mysqli_query($connection, $query)){
                    echo "Deletion successful";
                }else{
                    echo "Deletion failed";
                }
            }

        ?>
    </div>

    <h4>Print Report</h4>

    <div>
        <ul>
            <li class = 'currcourse'>2 print report buttons here</li>
        </ul> 

    </div>

    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>
