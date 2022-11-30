<?php
session_start();
// adminHome.php

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
			<label >Course Name</label>
			<input type="text" name="courseName" required>
		</div>

		<div style="padding-top: 10px;"></div>

		<div>
			<label>Major</label>
			<input type="text" name="major" required>
		</div>
		<button type="submit">Submit</button>
	</form>	

    <?php
        $courseName = $_POST['courseName'];
        $courseMajor = $_POST['courseMajor'];
    ?>



    <h3>Add User</h3>
    <form action="adminHome.php" method="post">
		<div>
			<label >User login</label>
			<input type="text" name="userID" required>
		</div>

		<div style="padding-top: 10px;"></div>

		<div>
			<label>User password</label>
			<input type="text" name="password" required>
		</div>
		<button type="submit">Submit</button>
	</form>


    <?php
        $userID = $_POST['userID'];
        $pass = $_POST['password'];
    ?>


    <h3>View Student Schedule</h3>
    <form action="adminHome.php" method="post">
        <select name = 'option-selected'>
            <option value = "Caleb">Caleb Greenfield</option>
        </select>
		
        <button type = "submit">Submit</button>
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
                    </tr>";
                    $flag = false;
                }
                
                echo "<tr>";
                echo "<th> $row[0]</th>";
                echo "<th> $row[1]</th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[3]</th>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </div>



    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>