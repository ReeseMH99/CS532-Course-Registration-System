<?php
// validation.php
// validation page checks if username and password are in the User table
session_start();


//myslqi_connect(host, username, password)
$connection = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($connection, 'CourseRegDB2');	// connecting to Database


$email = $_POST['email'];	// username entered
$pass = $_POST['password'];	// password entered



//user ID search
$select = "SELECT userID FROM Users WHERE email = '$email' && password = '$pass';";
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

$select = "SELECT * FROM Users WHERE userID = '$userID';";
$result = mysqli_query($connection, $select);	
$array = mysqli_fetch_array($result);
$firstName = $array[3];
$lastName = $array[4];
$phone = $array[5];
$doB = $array[6];



// check if user was found in query
if($countStudent == 1){
	$countStudent = 0;
	$_SESSION['userID'] = $userID;      // storing user info into session
	$_SESSION['email'] = $email; 
	$_SESSION['firstName'] = $firstName; 
	$_SESSION['lastName'] = $lastName;
	$_SESSION['phone'] = $phone;
	$_SESSION['doB'] = $doB;
	header('location:studentHome.php');   // take user to homepage 

}elseif($countTeacher == 1){
	$countTeacher = 0;
	$countStudent = 0;
	$_SESSION['userID'] = $userID;      // storing user info into session
	$_SESSION['email'] = $email; 
	$_SESSION['firstName'] = $firstName; 
	$_SESSION['lastName'] = $lastName;
	$_SESSION['phone'] = $phone;
	$_SESSION['doB'] = $doB;
	header('location:teacherHome.php');

}elseif($countAdmin == 1){
	$countAdmin = 0;
	$countStudent = 0;
	$_SESSION['userID'] = $userID;      // storing user info into session
	$_SESSION['email'] = $email; 
	$_SESSION['firstName'] = $firstName; 
	$_SESSION['lastName'] = $lastName;
	$_SESSION['phone'] = $phone;
	$_SESSION['doB'] = $doB;
	header('location:adminHome.php');

}else{
	header('location:login.html');	//take user back to login/registration page
}


?>
