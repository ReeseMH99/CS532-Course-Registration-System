-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2022 at 12:12 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courseregdb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `title`) VALUES
(21, 'President'),
(22, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `advisors`
--

CREATE TABLE `advisors` (
  `advisorID` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `officePhone` varchar(15) NOT NULL,
  `officeNumber` varchar(15) NOT NULL,
  `departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advisors`
--

INSERT INTO `advisors` (`advisorID`, `title`, `officePhone`, `officeNumber`, `departmentID`) VALUES
(19, 'Mathematics Advisor', '(123)456-7891', 'GMCS100', 1),
(20, 'Sciences Advisor', '(123)456-7892', 'LH100', 2);

-- --------------------------------------------------------

--
-- Table structure for table `courseprerequisites`
--

CREATE TABLE `courseprerequisites` (
  `courseID` int(11) NOT NULL,
  `preReqID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courseprerequisites`
--

INSERT INTO `courseprerequisites` (`courseID`, `preReqID`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(3, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `courseNumber` varchar(10) NOT NULL,
  `majorID` int(11) NOT NULL,
  `requiredBool` tinyint(1) NOT NULL,
  `credits` int(2) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `courseNumber`, `majorID`, `requiredBool`, `credits`) VALUES
(1, 'Data Structures', 'CS320', 1, 1, 3),
(2, 'Algorithms', 'CS460', 1, 1, 3),
(3, 'Operating Systems', 'CS480', 1, 1, 3),
(4, 'Machine Learning', 'CS470', 1, 0, 3),
(5, 'Software Engineering', 'CS532', 1, 0, 3),
(6, 'Principles of Biology', 'BIO101', 2, 1, 3),
(7, 'Biostatistics', 'BIO215', 2, 1, 3),
(8, 'Human Anatomy', 'BIO251', 2, 1, 3),
(9, 'World of Dinosaurs', 'BIO317', 2, 0, 3),
(10, 'Microbiology', 'BIO350', 2, 0, 3),
(11, 'Statistical Principles', 'STAT250', 3, 1, 3),
(12, 'Applied Probablity', 'STAT550', 3, 1, 3),
(13, 'Linear Regression Models', 'STAT610', 3, 1, 3),
(14, 'Statistical Computing', 'STAT580', 3, 0, 3),
(15, 'Advanced Data Analytics', 'STAT670', 3, 0, 3),
(16, 'Algebra', 'MATH140', 4, 1, 3),
(17, 'Calculus 1', 'MATH150', 4, 1, 3),
(18, 'Calculus 2', 'MATH151', 4, 1, 3),
(19, 'Mathematical Programming', 'MATH340', 4, 0, 3),
(20, 'Linear Algebra', 'MATH524', 4, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `courseschedule`
--

CREATE TABLE `courseschedule` (
  `scheduleID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `semester` varchar(4) NOT NULL,
  `totalNumSeats` int(11) NOT NULL,
  `dateTime` varchar(100) NOT NULL,
  `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courseschedule`
--

INSERT INTO `courseschedule` (`scheduleID`, `courseID`, `teacherID`, `semester`, `totalNumSeats`, `dateTime`, `location`) VALUES
(1, 1, 11, 'SP22', 20, 'MWF 8:00', 'AH234'),
(2, 2, 11, 'SP22', 25, 'MWF 10:00', 'AH256'),
(3, 3, 12, 'SP22', 23, 'MWF 13:00', 'AH289'),
(4, 4, 11, 'SP22', 30, 'TH 9:00', 'AH232'),
(5, 5, 12, 'SP22', 35, 'TH 15:00', 'AH239'),
(6, 1, 11, 'FA22', 20, 'MWF 8:00', 'SSW234'),
(7, 2, 11, 'FA22', 25, 'MWF 10:00', 'SSW256'),
(8, 3, 12, 'FA22', 23, 'MWF 13:00', 'SSW289'),
(9, 4, 11, 'FA22', 30, 'TH 9:00', 'SSW232'),
(10, 5, 12, 'FA22', 35, 'TH 15:00', 'SSW239'),
(11, 1, 11, 'SP23', 20, 'MWF 8:00', 'SSE234'),
(12, 2, 11, 'SP23', 25, 'MWF 10:00', 'SSE256'),
(13, 3, 12, 'SP23', 23, 'MWF 13:00', 'SSE289'),
(14, 4, 11, 'SP23', 30, 'TH 9:00', 'SSE232'),
(15, 5, 12, 'SP23', 35, 'TH 15:00', 'SSE239'),
(16, 6, 13, 'SP22', 35, 'MWF 9:00', 'GMCS210'),
(17, 7, 14, 'SP22', 25, 'TTH 12:00', 'AL123'),
(18, 8, 13, 'SP22', 20, 'TTH 8:00', 'AL200'),
(19, 9, 14, 'SP22', 30, 'MW 14:00', 'GMCS420'),
(20, 10, 13, 'SP22', 25, 'MWF 10:00', 'GMCS110'),
(21, 6, 13, 'FA22', 35, 'MWF 8:00', 'SH222'),
(22, 7, 14, 'FA22', 30, 'TTH 9:30', 'SH104'),
(23, 8, 13, 'FA22', 25, 'TTH 15:00', 'P204'),
(24, 9, 14, 'FA22', 20, 'MW 11:00', 'LSN108'),
(25, 10, 14, 'FA22', 25, 'MWF 17:30', 'AH109'),
(26, 6, 13, 'SP23', 35, 'MWF 10:30', 'AH200'),
(27, 7, 14, 'SP23', 30, 'TTH 8:30', 'AH205'),
(28, 8, 14, 'SP23', 25, 'TTH 18:00', 'SH111'),
(29, 9, 14, 'SP23', 25, 'MW 14:00', 'SH124'),
(30, 10, 13, 'SP23', 20, 'MWF 13:00', 'GMCS101'),
(31, 11, 15, 'SP22', 30, 'M 11:00', 'HT100'),
(32, 12, 16, 'SP22', 25, 'MWF 14:00', 'SH109'),
(33, 13, 15, 'SP22', 32, 'TTH 8:00', 'AL301'),
(34, 14, 16, 'SP22', 20, 'TTH 18:00', 'GMCS125'),
(35, 15, 15, 'SP22', 20, 'MWF 13:00', 'HH134'),
(36, 11, 15, 'FA22', 30, 'M 10:00', 'AL201'),
(37, 12, 16, 'FA22', 25, 'MWF 14:00', 'GMCS300'),
(38, 13, 15, 'FA22', 20, 'TTH 9:30', 'AH108'),
(39, 14, 16, 'FA22', 25, 'TTH 12:00', 'PS100'),
(40, 15, 15, 'FA22', 30, 'MWF 16:00', 'P209'),
(41, 11, 16, 'SP23', 35, 'M 8:30', 'AL201'),
(42, 12, 15, 'SP23', 25, 'MWF 14:00', 'GMCS109'),
(43, 13, 16, 'SP23', 20, 'TTH 15:30', 'SH113'),
(44, 14, 15, 'SP23', 25, 'TTH 11:00', 'AH211'),
(45, 15, 16, 'SP23', 35, 'MWF 9:30', 'EBA222'),
(46, 16, 17, 'SP22', 25, 'M 14:00', 'AHS200'),
(47, 17, 17, 'SP22', 25, 'TTH 15:00', 'SH117'),
(48, 18, 18, 'SP22', 30, 'MW 12:00', 'HT104'),
(49, 19, 18, 'SP22', 25, 'TTH 9:30', 'GMCS200'),
(50, 20, 17, 'SP22', 30, 'MWF 16:00', 'P109'),
(51, 16, 18, 'FA22', 35, 'M 15:00', 'AH300'),
(52, 17, 17, 'FA22', 25, 'TTH 16:00', 'HH201'),
(53, 18, 17, 'FA22', 35, 'MW 10:00', 'SH111'),
(54, 19, 18, 'FA22', 20, 'MWF 12:00', 'HT134'),
(55, 20, 18, 'FA22', 25, 'TTH 17:30', 'AH101'),
(56, 16, 18, 'SP23', 30, 'M 13:00', 'AH209'),
(57, 17, 17, 'SP23', 35, 'TTH 11:00', 'HH109'),
(58, 18, 17, 'SP23', 35, 'MW 8:00', 'GMCS209'),
(59, 19, 18, 'SP23', 20, 'MWF 9:30', 'HT106'),
(60, 20, 18, 'SP23', 25, 'TTH 15:30', 'SH234');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`) VALUES
(0, 'None'),
(1, 'Sciences'),
(2, 'Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `majoradvisors`
--

CREATE TABLE `majoradvisors` (
  `majorID` int(11) NOT NULL,
  `advisorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `majorrequirements`
--

CREATE TABLE `majorrequirements` (
  `majorID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `majorrequirements`
--

INSERT INTO `majorrequirements` (`majorID`, `courseID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 6),
(2, 7),
(2, 8),
(1, 11),
(2, 11),
(3, 11),
(4, 11),
(3, 12),
(4, 12),
(3, 13),
(2, 16),
(3, 16),
(4, 16),
(1, 17),
(2, 17),
(3, 17),
(4, 17),
(4, 18),
(1, 20),
(3, 20),
(4, 20);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `title`, `departmentID`) VALUES
(0, 'None', 0),
(1, 'Computer Science', 1),
(2, 'Biology', 1),
(3, 'Statistics', 2),
(4, 'Math', 2);

-- --------------------------------------------------------

--
-- Table structure for table `studentmajor`
--

CREATE TABLE `studentmajor` (
  `studentID` int(11) NOT NULL,
  `majorID` int(11) NOT NULL,
  `minor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentID` int(11) NOT NULL,
  `majorID` int(11) NOT NULL,
  `minorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentID`, `majorID`, `minorID`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 1, 0),
(4, 2, 0),
(5, 2, 0),
(6, 2, 0),
(7, 3, 0),
(8, 3, 0),
(9, 4, 0),
(10, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studentschedule`
--

CREATE TABLE `studentschedule` (
  `studentID` int(11) NOT NULL,
  `scheduleID` int(11) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `gradeval` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentschedule`
--

INSERT INTO `studentschedule` (`studentID`, `scheduleID`, `grade`, `status`, `gradeval`) VALUES
(1, 2, 'B', 'PASS', 3),
(1, 3, 'A-', 'PASS', 3.7),
(1, 9, 'IP', 'IP', 0),
(1, 13, 'ENROLLED', 'ENROLLED', 0),
(1, 58, 'ENROLLED', 'ENROLLED', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacherID` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `officePhone` varchar(15) NOT NULL,
  `officeNumber` varchar(11) NOT NULL,
  `departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacherID`, `title`, `officePhone`, `officeNumber`, `departmentID`) VALUES
(11, 'Professor', '(432)123-4567', 'GMCS234', 1),
(12, 'Dr.', '(432)223-4567', 'GMCS235', 1),
(13, 'Professor', '(432)323-4567', 'GMCS236', 1),
(14, 'Professor', '(432)423-4567', 'GMCS237', 1),
(15, 'Professor', '(432)523-4567', 'LH340', 2),
(16, 'Professor', '(432)623-4567', 'LH341', 2),
(17, 'Dr.', '(432)723-4567', 'LH342', 2),
(18, 'Professor', '(432)823-4567', 'LH343', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `doB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `firstName`, `lastName`, `phone`, `doB`) VALUES
(1, 'g@gmail.com', '123', 'Caleb', 'Greenfield', '(123)765-4321', '2000-03-12'),
(2, 'm@gmail.com', '456', 'Maxim', 'Kanayasami', '(619)842-0909', '1999-02-26'),
(3, 'lb@gmail.com', '909', 'Lionel', 'Baker', '(808)919-7909', '2000-09-19'),
(4, 'jp@yahoo.com', '242', 'Jada', 'Phillips', '(818)923-1492', '2000-07-11'),
(5, 'ac@yahoo.com', '871', 'Ada', 'Chang', '(516)-290-8080', '1999-04-01'),
(6, 'zs@gmail.com', '823', 'Zion', 'Stanfield', '(619)931-0092', '2001-12-15'),
(7, 'rb@gmail.com', '001', 'Rachel', 'Brown', '(902)021-8809', '2000-07-20'),
(8, 'jw@gmail.com', '396', 'June', 'Williams', '(619)752-0397', '2002-03-13'),
(9, 'pw@gmail.com', '958', 'Phillip', 'Wayne', '(605)134-8750', '2002-04-01'),
(10, 'rm@gmail.com', '791', 'Robert', 'Man', '(851)092-9050', '1999-08-03'),
(11, 'al@signmeup.edu', '190', 'Axel', 'Lopez', '(619)759-8095', '1979-09-28'),
(12, 'mp@signmeup.edu', '390', 'Meredith', 'Palmer', '(619)309-1902', '1989-06-06'),
(13, 'bs@signmeup.edu', '706', 'Blake', 'Strong', '(619)413-7070', '1991-12-26'),
(14, 'fj@signmeup.edu', '649', 'Ferdinand', 'Jaurez', '(619)981-5290', '1986-07-22'),
(15, 'as@signmeup.edu', '589', 'Ashley', 'Sherman', '(619)079-1004', '1978-09-12'),
(16, 'jl@signmeup.edu', '006', 'John', 'Lynn', '(831)509-4239', '1989-06-20'),
(17, 'ij@signmeup.edu', '401', 'Isaac', 'Jacobs', '(619)052-7610', '1985-02-17'),
(18, 'ka@signmeup.edu', '787', 'Kayla', 'Atkinson', '(852)690-2480', '1990-08-16'),
(19, 'hy@signmeup.edu', '990', 'Hasan', 'Yusuf', '(619)284-9071', '1986-05-26'),
(20, 'sb@signmeup.edu', '760', 'Sandra', 'Burns', '(619)603-2508', '1982-08-16'),
(21, 'nc@signmeup.edu', '293', 'Nicholas', 'Cannon', '(619)915-8053', '1988-04-01'),
(22, 'tr@signmeup.edu', '658', 'Tanya', 'Reacher', '(412)510-4089', '1985-10-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `advisors`
--
ALTER TABLE `advisors`
  ADD PRIMARY KEY (`advisorID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `courseprerequisites`
--
ALTER TABLE `courseprerequisites`
  ADD PRIMARY KEY (`courseID`,`preReqID`),
  ADD KEY `preReqID` (`preReqID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courseschedule`
--
ALTER TABLE `courseschedule`
  ADD PRIMARY KEY (`scheduleID`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `teacherID` (`teacherID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majoradvisors`
--
ALTER TABLE `majoradvisors`
  ADD PRIMARY KEY (`majorID`,`advisorID`),
  ADD KEY `advisorID` (`advisorID`);

--
-- Indexes for table `majorrequirements`
--
ALTER TABLE `majorrequirements`
  ADD PRIMARY KEY (`majorID`,`courseID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `studentmajor`
--
ALTER TABLE `studentmajor`
  ADD PRIMARY KEY (`studentID`,`majorID`),
  ADD KEY `majorID` (`majorID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `majorID` (`majorID`),
  ADD KEY `minorID` (`minorID`);

--
-- Indexes for table `studentschedule`
--
ALTER TABLE `studentschedule`
  ADD PRIMARY KEY (`studentID`,`scheduleID`),
  ADD KEY `scheduleID` (`scheduleID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacherID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `courseschedule`
--
ALTER TABLE `courseschedule`
  MODIFY `scheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advisors`
--
ALTER TABLE `advisors`
  ADD CONSTRAINT `advisors_ibfk_1` FOREIGN KEY (`advisorID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `advisors_ibfk_2` FOREIGN KEY (`departmentID`) REFERENCES `departments` (`id`);

--
-- Constraints for table `courseprerequisites`
--
ALTER TABLE `courseprerequisites`
  ADD CONSTRAINT `courseprerequisites_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `courseprerequisites_ibfk_2` FOREIGN KEY (`preReqID`) REFERENCES `courses` (`id`);

--
-- Constraints for table `courseschedule`
--
ALTER TABLE `courseschedule`
  ADD CONSTRAINT `courseschedule_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `courseschedule_ibfk_2` FOREIGN KEY (`teacherID`) REFERENCES `teachers` (`teacherID`);

--
-- Constraints for table `majoradvisors`
--
ALTER TABLE `majoradvisors`
  ADD CONSTRAINT `majoradvisors_ibfk_1` FOREIGN KEY (`advisorID`) REFERENCES `advisors` (`advisorID`),
  ADD CONSTRAINT `majoradvisors_ibfk_2` FOREIGN KEY (`majorID`) REFERENCES `majors` (`id`);

--
-- Constraints for table `majorrequirements`
--
ALTER TABLE `majorrequirements`
  ADD CONSTRAINT `majorrequirements_ibfk_1` FOREIGN KEY (`majorID`) REFERENCES `majors` (`id`),
  ADD CONSTRAINT `majorrequirements_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `courses` (`id`);

--
-- Constraints for table `majors`
--
ALTER TABLE `majors`
  ADD CONSTRAINT `majors_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `departments` (`id`);

--
-- Constraints for table `studentmajor`
--
ALTER TABLE `studentmajor`
  ADD CONSTRAINT `studentmajor_ibfk_1` FOREIGN KEY (`majorID`) REFERENCES `majors` (`id`),
  ADD CONSTRAINT `studentmajor_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`majorID`) REFERENCES `majors` (`id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`minorID`) REFERENCES `majors` (`id`);

--
-- Constraints for table `studentschedule`
--
ALTER TABLE `studentschedule`
  ADD CONSTRAINT `studentschedule_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`),
  ADD CONSTRAINT `studentschedule_ibfk_2` FOREIGN KEY (`scheduleID`) REFERENCES `courseschedule` (`scheduleID`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `teachers_ibfk_2` FOREIGN KEY (`departmentID`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
