<?php
session_start();
// adminHome.php

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
        <title>Admin Home</title>
        <link rel="stylesheet" href="./Admin/styleAdmin.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h1 class = "studentName">Admin Home</h1>
    <hr>
    <div style="text-align:center">
        <a href="./adminHome.php"  style = "color: red" class = 'sub'>Home</a>
        <a href="./Admin/a_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./Admin/a_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./Admin/a_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./Admin/a_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <!-- <a href="./Admin/a_facultyCourse.php" class = 'sub'>Faculty Course Information</a> -->
    </div>
    </hr>

    <hr>
    </hr>
    <h2 class = "headers" >Welcome! <?php echo $_SESSION['username'];?></h2>
    

    <h4 class = "headers">Add User</h4>
    <form action="adminHome.php" method="post">
        <div>
            <label >UserID</label>
            <input style="margin-bottom: 5px" type="text" name="userID" required>
        </div>
        <div>
            <label>Email</label>
            <input style="margin-bottom: 5px" type="text" name="email" required>
        </div>
        <div>
            <label>Password</label>
            <input style="margin-bottom: 5px" type="text" name="Password" required>
        </div>
        <div>
            <label>First Name</label>
            <input style="margin-bottom: 5px" type="text" name="firstName" required>
        </div>
        <div>
            <label>Last Name</label>
            <input style="margin-bottom: 5px" type="text" name="lastName" required>
        </div>
        <div>
            <label>Phone</label>
            <input style="margin-bottom: 5px" type="text" name="phone" required>
        </div>
        <div>
            <label>Birthday</label>
            <input style="margin-bottom: 5px" type="text" name="doB" required>
        </div>
		<input type="submit" name = "submit" value = "Submit">
	</form>	

    <?php
    if(isset($_POST['submit'])){
        $userID = $_POST['userID'];
        $email = $_POST['email'];
        $password = $_POST['Password'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phone = $_POST['phone'];
        $doB = $_POST['doB'];

        $result = mysqli_query($connection, "INSERT INTO users 
        (userID, email, `password`, firstName, lastName, phone, doB)
        VALUES 
        ('$userID', '$email', '$password', '$firstName', '$lastName', '$phone', '$doB')");

        if($result) {
            echo "Added user successfully";
        }else {
            echo "Failed to add user";
        }
    }

    ?>


    <form action="logout.php" method="post">
        <button class ="logout" type="submit">Logout</button>
    </form>

</body>
</html>