<?php
session_start();

$connection = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($connection, 'CourseRegDB2');

//if variable not set
if(!isset($_SESSION['userID'])){
	//send user to login/registration page
	header('location:login.html');
}

$courseID = $_POST['courseID'];

$select = "SELECT title FROM Courses WHERE id = $courseID;";
$result = mysqli_query($connection, $select);	
$array = mysqli_fetch_array($result);
$courseTitle = $array[0];


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
    <h1>Register</h1>

    <h2><?php echo $courseTitle?></h2>








    
   

</body>
</html>