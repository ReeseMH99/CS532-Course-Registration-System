<?php
session_start();

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
        <title>Teacher: Course Grades</title>
        <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->

    <h1>Course Grades</h1>
    <hr>
    <div style="text-align:center">
        <a href="../teacherHome.php" class = 'sub'>Home</a>
        <a href="./t_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./t_courseGrades.php" style = "color: red" class = 'sub'>Course Grades</a>
        <a href="./t_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./t_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./t_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>

    <?php
        $gradeUpdate = $_POST['option-selected'];
        $user_ID = $_POST['user_id'];
        $sched_ID = $_POST['sched_id'];
        
        $select = "UPDATE studentschedule SET grade='$gradeUpdate' WHERE studentID='$user_ID' AND scheduleID='$sched_ID'";
        
        if ($connection->query($select) === TRUE) {
            echo"Student grade updated successfully";
           echo '<form action="t_viewGrades.php" method="post">
                    <input type="hidden" name="view" value="'.$user_ID.'">
                    <button type="submit">Back</button>
                </form>';
        } else {
            echo "Error updating record: " . $connection->error;
        }
        
    ?>
</html>




