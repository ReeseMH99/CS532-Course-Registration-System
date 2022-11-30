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
        <title>Teacher: Course Grades</title>
        <link rel="stylesheet" href="../style.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3>Grades for <?php echo $_POST["view"]; ?></h3>
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
        $userID = $_POST["view"];

        $select = "SELECT title FROM Majors M INNER JOIN Students S ON M.id=S.majorID WHERE S.studentID = $userID;";
        $result = mysqli_query($connection, $select);	
        $array = mysqli_fetch_array($result);
        $major = $array[0];

        $select = "SELECT title FROM Majors M INNER JOIN Students S ON M.id=S.minorID WHERE S.studentID = $userID;";
        $result = mysqli_query($connection, $select);	
        $array = mysqli_fetch_array($result);
        $minor = $array[0];


    ?>

    <h2>Fall 2022</h2>
        
        <div class = 'display'>
            <?php
                $userID = $_POST["view"];

                $select = "SELECT C.courseNumber, C.title, SS.grade, SS.status 
                            FROM Courses C 
                            INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                            INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID 
                            WHERE SS.studentID = $userID 
                            AND CS.semester = 'FA22'";

                $result = mysqli_query($connection, $select);
                $count = mysqli_num_rows($result);
                
                echo "<table><tr>
                <th>Course Number</th>
                <th>Course Name</th>
                <th>Grade</th>
                <th>Status</th>
                </tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<th> $row[0]</th>"; //courseNumber
                    echo "<th> $row[1]</th>"; //title
                    $currentGrade = $row[2];
                    $allOptionsStr = '
                        <option value="A">A</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B">B</option>
                        <option value="B-">B-</option>
                        <option value="C+">C+</option>
                        <option value="C">C</option>
                        <option value="C-">C-</option>
                        <option value="D+">D+</option>
                        <option value="D">D</option>
                        <option value="D-">D-</option>
                        <option value="F">F</option>
                        <option value="IP">IP</option>
                    ';
                    $gradePos = strpos($allOptionsStr, $currentGrade);
                    if (strlen($currentGrade) == 1) {
                        $optionsFormat = substr_replace($allOptionsStr, ' selected', $gradePos+2, 0);
                    }
                    elseif (strlen($currentGrade) == 2) {
                        $optionsFormat = substr_replace($allOptionsStr, ' selected', $gradePos+3, 0);
                    }
                    echo "<th>" .
                            '<form action="t_viewGrades.php" method="post" id="gradesform">
                                <select name="option-selected">' . 
                                    $optionsFormat .
                                '</select>
                            </form>'
                            . "</td>";
                    "</th>"; //grade $row[2]

                    echo "<th> $row[3]</th>"; //status
                    echo "</tr>";
                }
                echo "</table>";
            ?>
        </div>

    <h2>Spring 2022</h2>

        <div class = 'display'>
            <?php
                $userID = $_POST["view"];

                $select = "SELECT C.courseNumber, C.title, SS.grade, SS.status 
                            FROM Courses C 
                            INNER JOIN  courseSchedule CS on CS.courseID = C.id 
                            INNER JOIN studentSchedule SS on CS.scheduleID = SS.scheduleID 
                            WHERE SS.studentID = $userID
                            AND CS.semester = 'SP22'";

                $result = mysqli_query($connection, $select);
                $count = mysqli_num_rows($result);
                
                echo "<table><tr>
                <th>Course Number</th>
                <th>Course Name</th>
                <th>Grade</th>
                <th>Status</th>
                </tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<th> $row[0]</th>";
                    echo "<th> $row[1]</th>";
                    $currentGrade = (string) "\"" . $row[2] . "\"";
                    $allOptionsStr = '
                        <option value="A">A</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B">B</option>
                        <option value="B-">B-</option>
                        <option value="C+">C+</option>
                        <option value="C">C</option>
                        <option value="C-">C-</option>
                        <option value="D+">D+</option>
                        <option value="D">D</option>
                        <option value="D-">D-</option>
                        <option value="F">F</option>
                        <option value="IP">IP</option>
                    ';
                    $gradePos = strpos($allOptionsStr, $currentGrade);
                    if (strlen($currentGrade) == 3) {
                        $optionsFormat = substr_replace($allOptionsStr, ' selected', $gradePos+3, 0);
                    }
                    elseif (strlen($currentGrade) == 4) {
                        $optionsFormat = substr_replace($allOptionsStr, ' selected', $gradePos+4, 0);
                    }
                    echo "<th>" .
                            '<form action="t_updateGrades.php" method="post" id="gradesform">
                                <select name="option-selected[]">' . 
                                    $optionsFormat .
                                '</select>
                            </form>'
                            . "</td>";
                    "</th>"; //grade $row[2]
                    echo "<th> $row[3]</th>";
                    echo "</tr>";
                }
                echo "</table>";
            ?>
    </div>

<?php
    $newGrade = $_POST['option-selected'];
    echo "<form action='t_updateGrade.php' method = 'post'>
    <button type = 'submit' form = 'gradesform' name ='grade' value=$newGrade>Submit Grade Changes</button>
</form>
    <script>
        document.forms[1].submit();
    </script>";

?>


<form action="./t_courseGrades.php" method="post">
    <button type="submit">Back</button>
</form>

<form action="../logout.php" method="post">
    <button type="submit">Logout</button>
</form>

</body>
</html>