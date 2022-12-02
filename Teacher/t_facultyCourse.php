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
        <title>Teacher: Faculty Course Information</title>
        <link rel="stylesheet" href="./styleTeacher.css">
    <!--Additional elements for browsers and robots go here goes here-->
</head> 
<body>
    <!--Elements visible to users go here-->
    <h3 class = "studentName">Teacher</h3>
    <h1 class = "headers">Faculty Course Information</h1>
    <hr>
    <div style="text-align:center">
        <a href="../teacherHome.php" class = 'sub'>Home</a>
        <a href="./t_studentRecord.php" class = 'sub'>Student Record</a>
        <a href="./t_courseGrades.php" class = 'sub'>Course Grades</a>
        <!-- <a href="./t_courseRegistration.php" class = 'sub'>Course Registration</a> -->
        <!-- <a href="./t_majorRequirements.php" class = 'sub'>Major Requirements</a> -->
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
        echo "<form action='t_facultyCourse.php' method='post'>
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
                    echo "<h3>Instructor Info</h3>
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
                $select = "SELECT C.title, C.courseNumber, M.title
                            FROM Courses C 
                            INNER JOIN Majors M on C.majorID = M.id
                            WHERE C.id = $courseSelection";
                $result = mysqli_query($connection, $select);
                $row = mysqli_fetch_array($result);
                if($result){
                    echo "<h3>Course Info</h3>
                            <ul>
                                <li><strong>Number:</strong> $row[1]</li>
                                <li><strong>Title:</strong> $row[0]</li>
                                <li><strong>Major:</strong> $row[2]</li>
                            </ul>";

                    echo "<h3>Prerequisites</h3>";

                    $selectPR = "SELECT PR.preReqID
                            FROM courseprerequisites PR 
                            INNER JOIN Courses C on PR.courseID = C.id
                            WHERE C.id = $courseSelection";

                    $resultPR = mysqli_query($connection, $selectPR);
                    $count = mysqli_num_rows($resultPR);
                    if($resultPR and $count > 0){
                        while($rowPR = mysqli_fetch_array($resultPR)){

                            $selectPName = "SELECT title, courseNumber
                                FROM Courses 
                                WHERE id = $rowPR[0]";
                            $resultPName = mysqli_query($connection, $selectPName);
                            $rowName = mysqli_fetch_array($resultPName);
                            echo "<ul>
                                    <li>$rowName[1]: $rowName[0]</li>
                                </ul>";
                            
                        }
                    }else{
                        echo "<ul>
                                <li><em>N/A</em></li>
                            </ul>";
                    }


                    echo "<h3>Instructors: $semester</h3>";
                    $selectC = "SELECT T.title, U.firstName, U.lastName, T.officePhone, T.officeNumber, CS.dateTime, CS.location, CS.totalNumSeats
                                FROM courseSchedule CS
                                INNER JOIN Teachers T on T.teacherID = CS.teacherID
                                INNER JOIN Users U on U.userID = T.teacherID
                                WHERE CS.courseID = $courseSelection
                                AND CS.semester = '$semester'";
                    $resultC = mysqli_query($connection, $selectC);
                    $count = mysqli_num_rows($resultC);
                    if($resultC and $count > 0){
                        echo "<table>
                                <tr>
                                    <th><strong>Professor</strong></th>
                                    <th><strong>Office Location</strong></th>
                                    <th><strong>Office Phone</strong></th>
                                    <th><strong>Course Date/Time</strong></th>
                                    <th><strong>Course Location</strong></th>
                                    <th><strong>Total Seats</strong></th>
                                </tr>";
                        while($rowC = mysqli_fetch_array($resultC)){
                            echo "<tr>
                                    <th>$rowC[0] $rowC[1] $rowC[2]</th>
                                    <th>$rowC[4]</th>
                                    <th>$rowC[3]</th>
                                    <th>$rowC[5]</th>
                                    <th>$rowC[6]</th>
                                    <th>$rowC[7]</th>
                                </tr>";
                        }
                        echo "</table>";
                    }else{
                        echo "<ul>
                                <li><em>$row[1] does not have an assigned instructor for $semester.</em></li>
                            </ul>";
                    }
                }


            // All teachers all courses - - - - - - - - - - - - - - - - - - - - - - - - - 
            }elseif($courseSelection == "All Courses" and $facultyID == "All Faculty"){
                
                echo "<h3>All Courses and Instructors: $semester</h3>";

                $select = "SELECT C.id
                            FROM Courses C";
                $result = mysqli_query($connection, $select);
                while($row = mysqli_fetch_array($result)){
                    $selectI = "SELECT C.title, C.courseNumber, M.title
                            FROM Courses C 
                            INNER JOIN Majors M on C.majorID = M.id
                            WHERE C.id = $row[0]";
                    $resultI = mysqli_query($connection, $selectI);
                    $rowI = mysqli_fetch_array($resultI);
                    if($resultI){
                        echo "<h4>$rowI[1]: $rowI[0]  -  $rowI[2]</h4>";
                    
                        $selectC = "SELECT T.title, U.firstName, U.lastName, T.officePhone, T.officeNumber, CS.dateTime, CS.location, CS.totalNumSeats
                                    FROM courseSchedule CS
                                    INNER JOIN Teachers T on T.teacherID = CS.teacherID
                                    INNER JOIN Users U on U.userID = T.teacherID
                                    WHERE CS.courseID = $row[0]
                                    AND CS.semester = '$semester'";
                        $resultC = mysqli_query($connection, $selectC);
                        $count = mysqli_num_rows($resultC);
                        if($resultC and $count > 0){
                            echo "<table>
                                    <tr>
                                        <th><strong>Professor</strong></th>
                                        <th><strong>Office Location</strong></th>
                                        <th><strong>Office Phone</strong></th>
                                        <th><strong>Course Date/Time</strong></th>
                                        <th><strong>Course Location</strong></th>
                                        <th><strong>Total Seats</strong></th>
                                    </tr>";
                            while($rowC = mysqli_fetch_array($resultC)){
                                echo "<tr>
                                        <th>$rowC[0] $rowC[1] $rowC[2]</th>
                                        <th>$rowC[4]</th>
                                        <th>$rowC[3]</th>
                                        <th>$rowC[5]</th>
                                        <th>$rowC[6]</th>
                                        <th>$rowC[7]</th>
                                    </tr>";
                            }
                            echo "</table>";
                        }
                    }
                    echo "<hr>";
                }


            // one teacher one course - - - - - - - - - - - - - - - - - - - - - - - - - 
            }else{
                $select = "SELECT T.teacherID, T.title, U.firstName, U.lastName, T.officeNumber, T.officePhone, D.title 
                            FROM Teachers T 
                            INNER JOIN Users U on T.teacherID = U.userID
                            INNER JOIN Departments D on T.departmentID = D.id
                            WHERE T.teacherID = $facultyID";
                $result = mysqli_query($connection, $select);
                $row = mysqli_fetch_array($result);
                if($result){
                    echo "<h3>Instructor Info: $semester</h3>
                            <ul>
                                <li><strong>Name:</strong> $row[1] $row[2] $row[3]</li>
                                <li><strong>ID:</strong> $row[0]</li>
                                <li><strong>Office Location:</strong> $row[4]</li>
                                <li><strong>Office Phone:</strong> $row[5]</li> 
                                <li><strong>Department:</strong> $row[6]</li>
                            </ul>";

                    $selectC = "SELECT C.courseNumber, C.title, CS.dateTime, CS.location, CS.totalNumSeats
                        FROM courseSchedule CS
                        INNER JOIN Teachers T on T.teacherID = CS.teacherID
                        INNER JOIN Courses C on C.id = CS.courseID
                        WHERE CS.teacherID = $facultyID
                        AND CS.semester = '$semester'
                        AND CS.courseID = $courseSelection";
                    $resultC = mysqli_query($connection, $selectC);
                    $count = mysqli_num_rows($resultC);
                    $rowC = mysqli_fetch_array($resultC);

                    if($count == 0){
                        echo "<ul>
                                <li><em>$row[1] $row[2] $row[3] will not teach the selected course in $semester.</em></li>
                            </ul>";
                       
                    }else{
                        echo "<h3>Course Info: $semester</h3>
                                <ul>
                                    <li><strong>Number:</strong> $rowC[1]</li>
                                    <li><strong>Title:</strong> $rowC[0]</li>
                                    <li><strong>Major:</strong> $rowC[2]</li>
                                </ul>";
                        
                        echo "<table>
                                <tr>
                                    <th><strong>Course Date/Time</strong></th>
                                    <th><strong>Course Location</strong></th>
                                    <th><strong>Total Seats</strong></th>
                                </tr>";

                        echo "<tr>
                                <th>$rowC[2]</th>
                                <th>$rowC[3]</th>
                                <th>$rowC[4]</th>
                            </tr>";

                        while($rowC = mysqli_fetch_array($resultC)){
                            echo "<tr>
                                    <th>$rowC[2]</th>
                                    <th>$rowC[3]</th>
                                    <th>$rowC[4]</th>
                                </tr>";
                        }
                        echo "</table>";

                        echo "<h3>Prerequisites</h3>";

                        $selectPR = "SELECT PR.preReqID
                                FROM courseprerequisites PR 
                                INNER JOIN Courses C on PR.courseID = C.id
                                WHERE C.id = $courseSelection";

                        $resultPR = mysqli_query($connection, $selectPR);
                        $count = mysqli_num_rows($resultPR);
                        if($resultPR and $count > 0){
                            while($rowPR = mysqli_fetch_array($resultPR)){

                                $selectPName = "SELECT title, courseNumber
                                    FROM Courses 
                                    WHERE id = $rowPR[0]";
                                $resultPName = mysqli_query($connection, $selectPName);
                                $rowName = mysqli_fetch_array($resultPName);
                                echo "<ul>
                                        <li>$rowName[1]: $rowName[0]</li>
                                    </ul>";
                                
                            }
                        }else{
                            echo "<ul>
                                    <li><em>N/A</em></li>
                                </ul>";
                        }

                    }
                    
                }
                
                


            }

        ?>
    </div>




    



    
    <form action="../logout.php" method="post">
        <button class = "logout" type="submit">Logout</button>
    </form>

</body>
</html>