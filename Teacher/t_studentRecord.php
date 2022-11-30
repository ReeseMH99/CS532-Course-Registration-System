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
        <title>Teacher: Student Records</title>
        <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3>Teacher</h3>
    <h1>Student Records</h1>
    <hr>
    <div style="text-align:center">
        <a href="../teacherHome.php" class = 'sub'>Home</a>
        <a href="./t_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./t_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./t_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./t_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./t_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>
    
    <h2>All Students</h2>
    
    <?php
        // show all student names and IDs
        $select = "SELECT * FROM students s INNER JOIN users u ON s.studentID=u.userID";
        $result = mysqli_query($connection, $select);

        echo "<table>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>";

        while($row=mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$row['studentID']."</td>";
            echo "<td>".$row['firstName']."</td>";
            echo "<td>".$row['lastName']."</td>";
            echo "<td>" . 
                    '<form action="t_viewStudentRecord.php" method="post">
                        <input type="hidden" name="view" value="'.$row['studentID'].'">
                        <button type="submit">View Student Record</button>
                        </form>' . "</td>";
            echo "</tr>";

        }
        echo "</table>";


    ?>
    

    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>