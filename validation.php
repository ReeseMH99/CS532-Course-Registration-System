<?php
// validation.php
// validation page checks if username and password are in the User table
session_start();


//myslqi_connect(host, username, password)
$connection = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($connection, 'CourseRegDB');	// connecting to Database


$name = $_POST['user'];	// username entered
$pass = $_POST['password'];	// password entered



//user ID search
$select = "SELECT userID FROM Users WHERE userName = '$name' && password = '$pass';";
$result = mysqli_query($connection, $select);	// query results
$array = mysqli_fetch_array($result);
$userID = $array[0];


//Student?
$select = "SELECT * FROM Students WHERE studentID = '$userID';";
$result = mysqli_query($connection, $select);	
$countStudent = mysqli_num_rows($result);             // counting number of rows from query results


//Teacher?
$select = "SELECT * FROM Teachers WHERE teacherID = '$userID';";
$result = mysqli_query($connection, $select);	
$countTeacher = mysqli_num_rows($result);

// //Admin?
$select = "SELECT * FROM Admins WHERE adminID = '$userID';";
$result = mysqli_query($connection, $select);	
$countAdmin = mysqli_num_rows($result);



// check if user was found in query
if($countStudent == 1){
	$countStudent = 0;
	$_SESSION['username'] = $name;      // storing username into session
	header('location:studentHome.php');   // take user to homepage 

}elseif($countTeacher == 1){
	$countTeacher = 0;
	$_SESSION['username'] = $name;
	header('location:teacherHome.php');

}elseif($countAdmin == 1){
	$countAdmin = 0;
	$_SESSION['username'] = $name;
	header('location:adminHome.php');

}else{
	header('location:login.html');	//take user back to login/registration page
}


?>
