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
        <title>Student: Major Requirements</title>
        <link rel="stylesheet" href="./styleStudent.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3 class = "studentName"><?php echo $_SESSION['firstName'];?></h3>
    <h1 class = "headers">Major Requirements</h1>
    <hr>
    <div style="text-align:center">
        <a href="../studentHome.php" class = 'sub'>Home</a>
        <a href="./s_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./s_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./s_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./s_majorRequirements.php"  style = "color: red" class = 'sub'>Major Requirements</a>
        <a href="./s_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>
    
    <h2 class = "headers" >Search Requirements by Major</h2>
    <?php
        $select = "SELECT id, title 
                    FROM Majors";
        $result = mysqli_query($connection, $select);
        echo "<form action='s_majorRequirements.php' method='post'>
                <select name='option-selected'>";
        $row = mysqli_fetch_array($result); 
        while($row = mysqli_fetch_array($result)){
            echo "<option value=$row[0]>$row[1]</option>";
        }
        echo "      </select>
                <button type='submit'>Submit</button>
            </form>";
    ?>
    
    <div class = 'display'>
        <?php
            $majorSearch = $_POST['option-selected'];
            $select = "SELECT C.courseNumber, C.title
                         FROM Courses C 
                         INNER JOIN  majorRequirements MR on MR.courseID = C.id 
                         WHERE MR.majorID = $majorSearch";
            //$select2 = "SELECT $select FROM courses WHERE requiredBool = 1"
            $result = mysqli_query($connection, $select);	
            echo "<table><tr><th>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<th> $row[0]</th>";
                echo "<th> $row[1]</th>";
                echo "</tr>";
            }
            echo "</table>";
            
        
        ?>
    </div>

    <h2 class = "headers">Search Outline by Major</h2>
    <form action="s_majorRequirements.php" method="post">
        <select name="option-selected">
            <option value="1">Computer Science</option>
            <option value="2">Biology</option>
            <option value="3">Statistics</option>
            <option value="4">Math</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    
    <div class = 'display'>
        <?php
            $majorSearch = $_POST['option-selected'];
            $select = "SELECT * FROM courses WHERE majorID = $majorSearch;";
            $result = mysqli_query($connection, $select);	
            echo "<table><tr><th>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[1]</th>";
                echo "</tr>";
            }
            echo "</table>";
            
        
        ?>
    </div>

    <form action="../logout.php" method="post">
        <button class = "logout" style="margin-top: 30px" type="submit">Logout</button>
    </form>

</body>
</html>