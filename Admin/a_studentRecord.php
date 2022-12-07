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
    <title>Admin: Student Record</title>
    <link rel="stylesheet" href="./styleAdmin.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3 class = "studentName">Admin: <?php echo $_SESSION['firstName'];?></h3>
    <h1 class = "headers">Student Record</h1>
    <hr>
    <div style="text-align:center">
        <a href="../adminHome.php" class = 'sub'>Home</a>
        <a href="./a_studentRecord.php" style = "color: red" class = 'sub'>Student Record</a>
        <a href="./a_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./a_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./a_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <!-- <a href="./a_facultyCourse.php" class = 'sub'>Faculty Course Information</a> -->
    </div>
    </hr>
    <hr>
    
    <h2 class = "headers">All Students</h2>
    
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
                    '<form action="a_viewStudentRecord.php" method="post">
                        <input type="hidden" name="view" value="'.$row['studentID'].'">
                        <button type="submit">View Student Record</button>
                        </form>' . "</td>";
            echo "</tr>";

        }
        echo "</table>";


    ?>
    

    <form action="../logout.php" method="post">
        <button class = "logout" type="submit">Logout</button>
    </form>

</body>
</html>
