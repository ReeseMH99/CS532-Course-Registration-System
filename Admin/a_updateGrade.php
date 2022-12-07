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
        <title>Admin: Course Grades</title>
        <link rel="stylesheet" href="./styleAdmin.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->

    <h3 class = "studentName">Admin: <?php echo $_SESSION['firstName'];?> </h3>
    <h1 class = "headers">Course Grades</h1>
    <hr>
    <div style="text-align:center">
        <a href="../adminHome.php" class = 'sub'>Home</a>
        <a href="./a_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./a_courseGrades.php" style = "color: red" class = 'sub'>Course Grades</a>
        <a href="./a_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./a_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <!-- <a href="./a_facultyCourse.php" class = 'sub'>Faculty Course Information</a> -->
    </div>
    </hr>
    <hr>

    <?php
        $gradeUpdate = $_POST['option-selected'];
        $user_ID = $_POST['user_id'];
        $sched_ID = $_POST['sched_id'];

        
        $select = "UPDATE studentschedule SET grade='$gradeUpdate' WHERE studentID='$user_ID' AND scheduleID='$sched_ID'";
        
        if ($connection->query($select) === TRUE) {
            echo "<h2> Student grade updated successfully! </h2>";
            //echo"Student grade updated successfully!";
           echo '<form action="a_viewGrades.php" method="post">
                    <input type="hidden" name="view" value="'.$user_ID.'">
                    <button style = "margin-top: 15px" type="submit">Back</button>
                </form>';
        } else {
            echo "Error updating record: " . $connection->error;
        }
        
    ?>
</html>




