<?php
session_start();

$connection = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($connection, 'CourseRegDB2');

//if variable not set
if(!isset($_SESSION['userID'])){
	//send user to login/registration page
	header('location:login.html');
}

$userID = $_SESSION['userID'];
$courseID = $_POST['courseID'];

$select = "SELECT title FROM Courses WHERE id = $courseID";
$result = mysqli_query($connection, $select);	
$array = mysqli_fetch_array($result);
$courseTitle = $array[0];

$select2 = "SELECT scheduleID FROM courseschedule
            WHERE courseID = $courseID
            AND semester = 'SP23'";
$result2 = mysqli_query($connection, $select2);
$array2 = mysqli_fetch_array($result2);

if(isset($_POST['courseID'])){
    $query = "INSERT INTO studentschedule (studentID, scheduleID, grade, `status`, gradeval)
                VALUES ('$userID','$array2[0]','ENROLLED','ENROLLED', '0')";
                
    if(mysqli_query($connection, $query)){
        echo "Registration successful";
    }else{
        echo "Registration failed";
    }
}

?>

<!DOCTYPE html> 
<html lang="en-us"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <link rel="stylesheet" href="./styleStudent.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <h1>Registration For:</h1>

    <h2><?php echo $courseTitle?></h2>
   

</body>
</html>