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
        <a href="../teacherHome.php" class = 'sub'>Home</a>
        <a href="./t_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./t_courseGrades.php" class = 'sub'>Course Grades</a>
        <a href="./t_courseRegistration.php" class = 'sub'>Course Registration</a>
        <a href="./t_majorRequirements.php" class = 'sub'>Major Requirements</a>
        <a href="./t_facultyCourse.php"  style = "color: red" class = 'sub'>Faculty Course Information</a>
    </div> 
    </hr>
    <hr>
    
    <h2>Faculty and Course Information</h2>
    <h4>Query by Faculty, Course, and Semester</h4>


    <?php
        $SP22 = "SP22";
        $FA22 = "FA22";
        $SP23 = "SP23";

        // Teacher Selection - - - - - - - - - - - - - - - - - - 
        $select = "SELECT T.teacherID, U.firstName, U.lastName 
                    FROM Teachers T 
                    INNER JOIN Users U on T.teacherID = U.userID";
        $result = mysqli_query($connection, $select);
        echo "<form action='s_facultyCourse.php' method='post'>
                    <label for = 'facultySelect'> Search Teacher:</label>
                    <input type = 'text' name = 'facultySelect' id = 'facultySelect' list = 'facultyList'>
                    <datalist id = 'facultyList'>
                    <option value = 'All Faculty'>All Faculty</option>";
        while($row = mysqli_fetch_array($result)){
            echo "<option value = '$row[0]'>$row[1] $row[2]</option>";
        }
        echo "      </datalist>";

        // Course Selection - - - - - - - - - - - - - - - - - - 
        $select = "SELECT id, title
            FROM Majors";
        $resultMajors = mysqli_query($connection, $select);
        $majorRow = mysqli_fetch_array($resultMajors);
        echo "<label for = 'courseSelection'>  Search Courses:</label>
                <select name='courseSelection'>
                <option value='All Courses'>All</option>";

        while($majorRow = mysqli_fetch_array($resultMajors)){
            echo "<optgroup label='$majorRow[1]'>";
            $select = "SELECT id, title, courseNumber
            FROM Courses
            WHERE majorID = $majorRow[0]";
            $resultCourses = mysqli_query($connection, $select);
            while($courseRow = mysqli_fetch_array($resultCourses)){ 
                echo "<option value='$courseRow[0]'>$courseRow[2]: $courseRow[1]</option>";
            }
            echo "</outgroup>";
        }
        echo "</select>";

        // Semester Selection - - - - - - - - - - - - - - - - - - - - - - -

        echo "      <select name='semester'>
                        <option value='$SP22'>Spring 2022</option>
                        <option value='$FA22' selected>Fall 2022</option>
                        <option value='$SP23'>Spring 2023</option>
                    </select>
                    <button type='submit'>Search</button>
                </form>";
    ?>

    <div class = 'display'>
        <?php
            $courseSelection = $_POST['courseSelection']; 
            $facultyID = $_POST['facultySelect'];
            $semester = $_POST['semester'];

            // All courses one teacher - - - - - - - - - - - - - - - - - - - - - - - - - 
            if($courseSelection == "All Courses" and $facultyID != "All Faculty"){
                $select = "SELECT T.teacherID, T.title, U.firstName, U.lastName, T.officeNumber, T.officePhone, D.title 
                            FROM Teachers T 
                            INNER JOIN Users U on T.teacherID = U.userID
                            INNER JOIN Departments D on T.departmentID = D.id
                            WHERE T.teacherID = $facultyID";
                $result = mysqli_query($connection, $select);
                $row = mysqli_fetch_array($result);
                if($result){
                    echo "<h3>Teacher Info</h3>
                            <ul>
                                <li><strong>Name:</strong> $row[1] $row[2] $row[3]</li>
                                <li><strong>ID:</strong> $row[0]</li>
                                <li><strong>Office Location:</strong> $row[4]</li>
                                <li><strong>Office Phone:</strong> $row[5]</li> 
                                <li><strong>Department:</strong> $row[6]</li>
                            </ul>";


                    echo "<h3>Courses: $semester</h3>";
                    $selectC = "SELECT C.courseNumber, C.title, CS.dateTime, CS.location, CS.totalNumSeats
                                FROM courseSchedule CS
                                INNER JOIN Teachers T on T.teacherID = CS.teacherID
                                INNER JOIN Courses C on C.id = CS.courseID
                                WHERE T.teacherID = $facultyID
                                AND CS.semester = '$semester'";
                    $resultC = mysqli_query($connection, $selectC);
                    $count = mysqli_num_rows($resultC);

                    echo "<table>
                            <tr>
                                <th><strong>Course Number</strong></th>
                                <th><strong>Course Name</strong></th>
                                <th><strong>Day and Time</strong></th>
                                <th><strong>Location</strong></th>
                                <th><strong>Total Seats</strong></th>
                            </tr>";
                    while($rowC = mysqli_fetch_array($resultC)){
                        echo "<tr>
                                <th>$rowC[0]</th>
                                <th>$rowC[1]</th>
                                <th>$rowC[2]</th>
                                <th>$rowC[3]</th>
                                <th>$rowC[4]</th>
                            </tr>";
                    }
                    echo "</table>";
                }

            // All teachers one course - - - - - - - - - - - - - - - - - - - - - - - - - 
            }elseif($courseSelection != "All Courses" and $facultyID == "All Faculty"){

                echo "<h4>All teachers - One course</h4>";



            // All teachers all courses - - - - - - - - - - - - - - - - - - - - - - - - - 
            }elseif($courseSelection == "All Courses" and $facultyID == "All Faculty"){

                echo "<h4>All teachers - All courses</h4>";



            // one teacher one course - - - - - - - - - - - - - - - - - - - - - - - - - 
            }else{
                
                echo "<h4>One teacher - One course</h4>";



            }

        ?>
    </div>




    



    
    <form action="../logout.php" method="post">
        <button type="submit">Logout</button>
    </form>

</body>
</html>