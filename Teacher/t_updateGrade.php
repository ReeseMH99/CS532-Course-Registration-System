<?php
session_start();

$connection = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($connection, 'CourseRegDB2');

//if variable not set
if(!isset($_SESSION['userID'])){
	//send user to login/registration page
	header('location:login.html');
}

$gradeUpdate = $_POST['option-selected'];
$userID = $_POST["view"];

echo $gradeUpdate;
echo $userID;

//$select = "UPDATE studentschedule SET grade=$gradeUpdate WHERE studentID=$userID";

//if ($connection->query($select) === TRUE) {
    //echo "Record updated successfully";
//} else {
    //echo "Error updating record: " . $connection->error;
//}


?>

<!DOCTYPE html> 
<html lang="en-us"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
