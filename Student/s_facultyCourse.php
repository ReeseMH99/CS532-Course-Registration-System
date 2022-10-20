<?php
session_start();


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
        <title>Student: Faculty Course Information</title>
        <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3><?php echo $_SESSION['firstName'];?></h3>
    <h1>Faculty Course Information</h1>
    <hr>
    <div style="text-align:center">
        <a href="../studentHome.php" class = 'sub'>Home</a>
        <a href="./s_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./s_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./s_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./s_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./s_facultyCourse.php" class = 'sub'>Faculty Course Information</a>
    </div>
    </hr>
    <hr>
    
    <h2>Faculty and Course Information</h2>
    <h4>Query by faculty name or facultyID</h4>
    <form action="s_facultyCourse.php" method="post">
        <select name="option-selected">
            <option value="11">Axel Lopez</option>
            <option value="12">Meredith Palmer</option>
            <option value="13">Blake Strong</option>
            <option value="14">Ferdinand Jaurez</option>
            <option value="15">Ashley Sherman</option>
            <option value="16">John Lynn</option>
            <option value="17">Isaac Jacobs</option>
            <option value="18">Kayla Atkinson</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    
    <div class = 'display'>
        <?php
            $facultySearch = $_POST['option-selected'];
            $select = "SELECT * FROM courses WHERE majorID = $facultySearch;";
            $result = mysqli_query($connection, $select);	
            echo "<table><tr><th>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<th><form action='s_facultyCourse.php' method='post' target = 'blank'>
                    </form></th>";
                echo "<th> $row[2]</th>";
                echo "<th> $row[1]</th>";
                echo "</tr>";
            }
            echo "</table>";
            
        
        ?>
    </div>
    <h4>Query by course name or courseID</h4>
    
    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>