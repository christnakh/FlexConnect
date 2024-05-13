-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 13, 2024 at 07:51 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FlexConnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `Applications`
--

CREATE TABLE `Applications` (
  `ApplicationID` int(11) NOT NULL,
  `JobID` int(11) DEFAULT NULL,
  `ApplicantID` int(11) DEFAULT NULL,
  `ApplicationDate` date DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ApplyJob`
--

CREATE TABLE `ApplyJob` (
  `ApplyID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `JobID` int(11) DEFAULT NULL,
  `EmployerID` int(11) DEFAULT NULL,
  `ConnectionStatus` varchar(255) DEFAULT NULL,
  `ConnectedSince` date DEFAULT NULL,
  `STATUS` char(8) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ApplyJob`
--

INSERT INTO `ApplyJob` (`ApplyID`, `UserID`, `JobID`, `EmployerID`, `ConnectionStatus`, `ConnectedSince`, `STATUS`) VALUES
(8, 5, 75, 1, 'Elio wants to apply for the job you posted. Click <a href=\'ViewJob.php?jobID=75\'>here</a> to view the job and accept the application.', '2024-03-05', 'Accepted'),
(9, 1, 76, 5, 'Elio123456789 wants to apply for the job you posted. Click <a href=\'ViewJob.php?jobID=76\'>here</a> to view the job and accept the application.', '2024-04-05', 'Pending'),
(11, 2, 75, 1, 'Elio2 wants to apply for the job you posted. Click <a href=\'ViewJob.php?jobID=75\'>here</a> to view the job and accept the application.', '2024-05-11', 'Pending'),
(12, 2, 79, 1, 'Elio2 wants to apply for the job you posted. Click <a href=\'ViewJob.php?jobID=79\'>here</a> to view the job and accept the application.', '2024-05-11', 'Pending'),
(13, 2, 84, 1, 'Elio2 wants to apply for the job you posted. Click <a href=\'ViewJob.php?jobID=84\'>here</a> to view the job and accept the application.', '2024-05-11', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `CommentID` int(11) NOT NULL,
  `PostID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CommentText` text,
  `CommentDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`CommentID`, `PostID`, `UserID`, `CommentText`, `CommentDate`) VALUES
(146, 1046, 5, '34', '2024-05-13 20:48:54'),
(147, 1039, 1, 'sdsqwqsds', '2024-05-13 20:48:56'),
(148, 1039, 1, 'ds', '2024-05-13 20:48:57'),
(149, 1039, 1, 'm', '2024-05-13 20:49:34'),
(150, 1043, 1, 'ds', '2024-05-13 21:20:09'),
(151, 1046, 1, '34', '2024-05-13 21:20:20'),
(152, 1175, 1, 'kol khara', '2024-05-13 21:30:16'),
(153, 1039, 1, 'sd', '2024-05-13 22:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `Connections`
--

CREATE TABLE `Connections` (
  `ConnectionID` int(11) NOT NULL,
  `UserID1` int(11) DEFAULT NULL,
  `UserID2` int(11) DEFAULT NULL,
  `ConnectionStatus` varchar(255) DEFAULT NULL,
  `ConnectedSince` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Degree`
--

CREATE TABLE `Degree` (
  `DegreeID` int(6) NOT NULL,
  `degree_Type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Degree`
--

INSERT INTO `Degree` (`DegreeID`, `degree_Type`) VALUES
(1, 'Bachelor of Science'),
(2, 'Master of Science'),
(3, 'Doctor of Philosophy'),
(4, 'Associate Degree'),
(5, 'Diploma'),
(6, 'Certificate');

-- --------------------------------------------------------

--
-- Table structure for table `developerSkills`
--

CREATE TABLE `developerSkills` (
  `developerSkillsID` int(6) NOT NULL,
  `skills_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `developerSkills`
--

INSERT INTO `developerSkills` (`developerSkillsID`, `skills_type`) VALUES
(1, 'Programming Languages'),
(2, 'Web Development'),
(3, 'Database Management'),
(4, 'Frameworks'),
(5, 'Version Control'),
(6, 'DevOps'),
(7, 'Cloud Services'),
(8, 'API Development'),
(9, 'Mobile App Development'),
(10, 'Testing'),
(11, 'Security'),
(12, 'Agile Methodologies'),
(13, 'Code Review'),
(14, 'CI/CD'),
(15, 'IDEs'),
(16, 'Data Structures'),
(17, 'Algorithms'),
(18, 'Problem Solving'),
(19, 'Web Servers'),
(20, 'Build Tools'),
(21, 'Dependency Management'),
(22, 'RESTful Architecture'),
(23, 'Data Modeling'),
(24, 'Machine Learning'),
(25, 'Big Data'),
(26, 'IoT'),
(27, 'Blockchain'),
(28, 'CI/CD Tools'),
(29, 'Performance Optimization'),
(30, 'Code Documentation'),
(31, 'Web Security'),
(32, 'Code Analysis'),
(33, 'Localization/Internationalization'),
(34, 'Microservices Architecture'),
(35, 'Scripting'),
(36, 'Web Scraping'),
(37, 'Game Development'),
(38, 'Data Visualization'),
(39, 'Virtualization'),
(40, 'Networking'),
(41, 'UX/UI Design'),
(42, 'Responsive Design'),
(43, 'Package Managers'),
(44, 'Linux/Unix Commands'),
(45, 'WebAssembly (Wasm)'),
(46, 'GraphQL'),
(47, 'Serverless Computing'),
(48, 'Data Warehousing'),
(49, 'Continuous Monitoring'),
(50, 'Chatbot Development'),
(51, 'WebRTC'),
(52, 'Content Management Systems (CMS)'),
(53, 'Progressive Web Apps (PWAs)'),
(54, 'Web Accessibility'),
(55, 'Payment Gateway Integration'),
(56, 'WebSockets'),
(57, 'FaaS (Function as a Service)');

-- --------------------------------------------------------

--
-- Table structure for table `Education`
--

CREATE TABLE `Education` (
  `EducationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `SchoolName` varchar(255) DEFAULT NULL,
  `Degree` varchar(255) DEFAULT NULL,
  `FieldOfStudy` varchar(255) DEFAULT NULL,
  `StartYear` year(4) DEFAULT NULL,
  `EndYear` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Education`
--

INSERT INTO `Education` (`EducationID`, `UserID`, `SchoolName`, `Degree`, `FieldOfStudy`, `StartYear`, `EndYear`) VALUES
(11, 1, 'Lebanese University', 'Bachelor of Science', 'Computer Science', 2023, 2024),
(15, 5, 'American University of Beirut', 'Diploma', 'User Experience (UX) Design', 2018, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `Endorsements`
--

CREATE TABLE `Endorsements` (
  `EndorsementID` int(11) NOT NULL,
  `SkillID` int(11) DEFAULT NULL,
  `EndorsedByUserID` int(11) DEFAULT NULL,
  `EndorsedUserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Experience`
--

CREATE TABLE `Experience` (
  `ExperienceID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Experience`
--

INSERT INTO `Experience` (`ExperienceID`, `UserID`, `CompanyName`, `Title`, `Location`, `StartDate`, `EndDate`, `Description`) VALUES
(8, 1, 'sds', 'sds', 'sds', '2024-02-15', '2024-02-13', 'sdsds'),
(9, 1, 'sds', 'dsds', 'dis', '2024-05-02', '2024-05-10', 'sds');

-- --------------------------------------------------------

--
-- Table structure for table `FieldStudy`
--

CREATE TABLE `FieldStudy` (
  `FieldStudyID` int(6) NOT NULL,
  `FieldStudyType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `FieldStudy`
--

INSERT INTO `FieldStudy` (`FieldStudyID`, `FieldStudyType`) VALUES
(1, 'Computer Science'),
(2, 'Web Development'),
(3, 'Software Engineering'),
(4, 'Information Technology'),
(5, 'Computer Applications'),
(6, 'Data Science'),
(7, 'Information Systems'),
(8, 'Computer Engineering'),
(9, 'Cybersecurity'),
(10, 'Network Administration'),
(11, 'Network Security'),
(12, 'Artificial Intelligence'),
(13, 'Human-Computer Interaction'),
(14, 'Robotics'),
(15, 'Machine Learning'),
(16, 'Mobile App Development'),
(17, 'User Experience (UX) Design'),
(18, 'Mobile Computing'),
(19, 'Mobile App Design and Development'),
(20, 'Software Quality Assurance'),
(21, 'Software Project Management'),
(22, 'Software Testing'),
(23, 'Software Quality Management'),
(24, 'Cloud Computing'),
(25, 'DevOps Engineering'),
(26, 'Cloud Architecture'),
(27, 'Cloud Infrastructure'),
(28, 'Database Management'),
(29, 'Data Warehousing'),
(30, 'Database Administration'),
(31, 'Database Systems'),
(32, 'Full Stack Development'),
(33, 'Front-end Development'),
(34, 'Back-end Development'),
(35, 'Full Stack Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `Groups`
--

CREATE TABLE `Groups` (
  `GroupID` int(11) NOT NULL,
  `GroupName` varchar(255) DEFAULT NULL,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Jobs`
--

CREATE TABLE `Jobs` (
  `JobID` int(11) NOT NULL,
  `EmployerID` int(11) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` text,
  `Location` varchar(255) DEFAULT NULL,
  `PostedDate` date DEFAULT NULL,
  `ApplicationDeadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Jobs`
--

INSERT INTO `Jobs` (`JobID`, `EmployerID`, `Title`, `Description`, `Location`, `PostedDate`, `ApplicationDeadline`) VALUES
(75, 1, 'testELIOELIOELIOELIO', 'test2', 'Hina', '2024-03-05', '2028-06-09'),
(76, 5, 'Labne ou Zeit', 'aa', 'aa', '2024-04-05', '2028-01-26'),
(77, 5, 'zaatar', 'sfs', 'ds', '2024-04-05', '2028-02-23'),
(78, 5, 'Boucher', 'sds', 'sds', '2024-04-05', '2027-02-09'),
(79, 1, 'mobile App deveopper', 'kjj', 'JOUNIEH', '2024-04-05', '2026-08-26'),
(80, 5, 'DQW', 'DQW', 'WDQ', '2024-05-11', '2024-06-11'),
(81, 5, 'dqwfqwd', 'dwqdwq', 'dwqwdq', '2024-05-11', '2024-06-10'),
(82, 5, 'dqwdqwdqw', 'qwdqwdqwd', 'qdwdwqwqd', '2024-05-11', '2024-07-04'),
(83, 1, 'dwqqwd', 'dwqwqd', 'dqwqdwqwd', '2024-05-11', '2024-05-09'),
(84, 1, 'dwqdqw', 'dwqwqdwqd', 'dqwqwdqdwdwq', '2024-05-11', '2024-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `MessageID` int(11) NOT NULL,
  `SenderID` int(11) DEFAULT NULL,
  `ReceiverID` int(11) DEFAULT NULL,
  `MessageText` text,
  `Timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`MessageID`, `SenderID`, `ReceiverID`, `MessageText`, `Timestamp`) VALUES
(1, 1, 1, 'sds', '2024-05-08 11:31:10'),
(2, 1, 1, 'sds', '2024-05-08 11:31:12'),
(3, 6, 1, 'sds', '2024-05-08 11:34:01'),
(4, 6, 2, 'dfd', '2024-05-08 11:34:11'),
(5, 6, 1, 'gay', '2024-05-08 11:34:23'),
(6, 1, 6, 'hi', '2024-05-08 11:34:37'),
(7, 6, 1, 'kifak', '2024-05-08 11:35:13'),
(8, 1, 6, 'mnih ou enta', '2024-05-08 11:35:29'),
(9, 6, 1, 'kes emak bi ayre akhou charmouta bteklo bel 20 meter', '2024-05-08 11:35:42'),
(10, 1, 6, 'sds', '2024-05-08 11:46:45'),
(11, 1, 6, 'ds', '2024-05-08 11:46:47'),
(12, 6, 1, 'jjty', '2024-05-08 11:47:02'),
(13, 1, 6, 'fuck u ', '2024-05-08 11:47:24'),
(14, 1, 6, 'xcx', '2024-05-08 11:47:35'),
(15, 6, 1, 'ghgh', '2024-05-08 11:47:43'),
(16, 1, 6, 'love you', '2024-05-08 11:47:47'),
(17, 1, 6, 'je taime', '2024-05-08 11:47:57'),
(18, 1, 6, 'trop', '2024-05-08 11:48:00'),
(19, 1, 6, 'zzz', '2024-05-08 11:48:02'),
(20, 1, 6, 'pipi', '2024-05-08 11:48:04'),
(21, 1, 6, 'caca', '2024-05-08 11:48:08'),
(22, 6, 1, 'elio gay', '2024-05-08 11:48:10'),
(23, 6, 1, 'elio want your zizi', '2024-05-08 11:48:21'),
(24, 1, 6, 'bayaj gay', '2024-05-08 11:48:25'),
(25, 6, 1, 'elio ', '2024-05-08 11:48:37'),
(26, 1, 6, 'sd', '2024-05-08 11:48:42'),
(27, 6, 1, 'wle', '2024-05-08 11:49:21'),
(28, 1, 1, 'sds', '2024-05-08 11:54:58'),
(29, 1, 1, 'sds', '2024-05-08 11:59:45'),
(30, 1, 1, 'sd', '2024-05-08 12:04:13'),
(31, 1, 6, 'xeeswrdtfyguhyr5de4w3erdtfyghjbgytdredrftgy', '2024-05-08 12:04:43'),
(32, 1, 6, 'sds', '2024-05-08 12:39:57'),
(33, 1, 6, 'xzxz', '2024-05-08 12:42:49'),
(34, 1, 6, 'zxz', '2024-05-08 12:42:50'),
(35, 1, 6, 'zxz', '2024-05-08 12:42:51'),
(36, 1, 6, 'xzxz', '2024-05-08 12:42:52'),
(37, 6, 5, 'sdssd', '2024-05-08 12:46:15'),
(38, 6, 1, 'hello', '2024-05-08 12:46:29'),
(39, 6, 1, 'hello', '2024-05-08 12:47:22'),
(40, 1, 1, 'Wasssapp nigga', '2024-05-13 15:34:23'),
(41, 1, 6, 'sdsd', '2024-05-13 18:51:19'),
(42, 1, 6, 'sds', '2024-05-13 19:06:16'),
(43, 1, 2, 'hello elio', '2024-05-13 19:30:48'),
(44, 1, 6, 'ddd', '2024-05-13 20:28:17'),
(45, 1, 6, 'dd', '2024-05-13 20:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `Notification`
--

CREATE TABLE `Notification` (
  `NotificationID` int(11) NOT NULL,
  `SenderUserID` int(11) DEFAULT NULL,
  `ReceiverUserID` int(11) DEFAULT NULL,
  `NotificationMessage` text,
  `NotificationType` varchar(50) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Notification`
--

INSERT INTO `Notification` (`NotificationID`, `SenderUserID`, `ReceiverUserID`, `NotificationMessage`, `NotificationType`, `Timestamp`) VALUES
(1, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-04-02 11:35:49'),
(2, 1, 5, 'Your application for the job \'Test1\' has been declined', 'Declined', '2024-04-02 11:36:00'),
(3, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-04-02 11:36:10'),
(4, 1, 5, 'Your application for the job \'Test1\' has been declined', 'Declined', '2024-04-02 11:38:39'),
(5, 1, 5, 'Your application for the job \'Test1\' has been declined', 'Declined', '2024-04-05 08:26:43'),
(6, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-04-05 08:26:47'),
(7, 1, 5, 'Your application for the job \'Test1\' has been declined', 'Declined', '2024-04-05 08:26:50'),
(8, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-04-05 08:26:52'),
(9, 1, 5, 'Your application for the job \'Test1\' has been declined', 'Declined', '2024-04-05 08:26:53'),
(10, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-04-05 08:26:58'),
(11, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-04-05 08:27:03'),
(12, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-04-05 08:29:12'),
(13, 1, 5, 'Your application for the job \'Test1\' has been declined', 'Declined', '2024-05-07 07:14:04'),
(14, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-05-07 07:14:07'),
(15, 1, 5, 'Your application for the job \'Test1\' has been declined', 'Declined', '2024-05-11 09:48:46'),
(16, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-05-11 09:48:48'),
(17, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-05-13 13:30:17'),
(18, 1, 2, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-05-13 13:30:21'),
(19, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-05-13 16:08:38'),
(20, 1, 5, 'Your application for the job \'Test1\' has been declined', 'Declined', '2024-05-13 16:08:40'),
(21, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-05-13 16:08:41'),
(22, 1, 5, 'Your application for the job \'Test1\' has been accepted', 'Accepted', '2024-05-13 17:43:36'),
(23, 1, 5, 'Your application for the job \'testELIOELIOELIOELIO\' has been declined', 'Declined', '2024-05-13 18:31:44'),
(24, 1, 5, 'Your application for the job \'testELIOELIOELIOELIO\' has been accepted', 'Accepted', '2024-05-13 18:31:45'),
(25, 1, 5, 'Your application for the job \'testELIOELIOELIOELIO\' has been accepted', 'Accepted', '2024-05-13 19:46:40'),
(26, 1, 5, 'Your application for the job \'testELIOELIOELIOELIO\' has been declined', 'Declined', '2024-05-13 19:46:41'),
(27, 1, 5, 'Your application for the job \'testELIOELIOELIOELIO\' has been accepted', 'Accepted', '2024-05-13 19:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `PostInteractions`
--

CREATE TABLE `PostInteractions` (
  `InteractionID` int(11) NOT NULL,
  `PostID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ReactionStatus` varchar(255) DEFAULT NULL,
  `Comment` text,
  `InteractionDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PostInteractions`
--

INSERT INTO `PostInteractions` (`InteractionID`, `PostID`, `UserID`, `ReactionStatus`, `Comment`, `InteractionDate`) VALUES
(11, 1039, 5, 'like', NULL, NULL),
(26, 1039, 1, 'like', NULL, NULL),
(27, 1043, 1, 'dislike', NULL, NULL),
(28, 1175, 1, 'dislike', NULL, NULL),
(29, 1041, 1, 'love', NULL, NULL),
(30, 1042, 1, 'like', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `PostID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Content` text,
  `PostDate` datetime DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`PostID`, `UserID`, `Content`, `PostDate`, `ImageURL`) VALUES
(1039, 1, 'this is my first postt on flex connect, im the first!', '2024-05-13 15:43:14', 'uiAaGl1t_Flexconnect1.png'),
(1041, 1, 'this is my first postt on flex connect, im the first!', '2024-05-13 15:43:14', 'Peppa.jpeg'),
(1042, 1, 'this is my first postt on flex connect, im the first!', '2024-05-13 15:43:15', 'OzQtw7MP_Flexconnect1.png'),
(1043, 1, 'this is my first postt on flex connect, im the first!', '2024-05-13 15:43:15', '8Km1mbZ1_Flexconnect1.png'),
(1044, 1, 'this is my first postt on flex connect, im the first!', '2024-05-13 15:43:15', 'Xx1tNVS7_Flexconnect1.png'),
(1045, 1, 'this is my first postt on flex connect, im the first!', '2024-05-13 15:43:15', '2vZ7WBvK_Flexconnect1.png'),
(1046, 1, 'this is my first postt on flex connect, im the first!', '2024-05-13 15:43:16', 'FBskkMRA_Flexconnect1.png'),
(1175, 1, 'i am elio the gay i like to eat dicks and i like to eat my moms boobs with alot of milk and christ fuck my mom everyday everysecondd', '2024-05-13 18:28:10', '9Wik61Hj_Screenshot 2024-05-13 at 9.28.04 PM.png'),
(1176, 1, 'i am fadoul i like to eats dicks and specialy christ dicks', '2024-05-13 18:29:44', '3zV8lnn5_Screenshot 2024-05-13 at 9.29.33 PM.png'),
(1177, 1, 'im christ from when i was little i loved to eat every ons\'s dicks there soooo goodd and also elio fucks my mom', '2024-05-13 18:33:14', '9yJoUVIx_IMG_2018.jpg'),
(1178, 1, 'im christ from when i was little i loved to eat every ons\'s dicks there soooo goodd and also elio fucks my mom', '2024-05-13 18:33:18', 'rOMOMrSM_IMG_2018.jpg'),
(1179, 1, 'im christ from when i was little i loved to eat every ons\'s dicks there soooo goodd and also elio fucks my mom', '2024-05-13 18:33:21', 'jjThEKxC_IMG_2018.jpg'),
(1180, 1, 'im christ from when i was little i loved to eat every ons\'s dicks there soooo goodd and also elio fucks my mom', '2024-05-13 18:33:26', 'N7wU2ksm_IMG_2018.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Recommendations`
--

CREATE TABLE `Recommendations` (
  `RecommendationID` int(11) NOT NULL,
  `RecommendedByUserID` int(11) DEFAULT NULL,
  `RecommendedUserID` int(11) DEFAULT NULL,
  `RecommendationText` text,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SchoolName`
--

CREATE TABLE `SchoolName` (
  `SchoolNameID` int(6) NOT NULL,
  `school_Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SchoolName`
--

INSERT INTO `SchoolName` (`SchoolNameID`, `school_Name`) VALUES
(31, 'Lebanese University'),
(32, 'American University of Beirut'),
(33, 'Saint Joseph University'),
(34, 'Beirut Arab University'),
(35, 'University of Balamand'),
(36, 'Lebanese American University'),
(37, 'University of Saint Joseph - USJ'),
(38, 'Lebanese International University'),
(39, 'Haigazian University'),
(40, 'Holy Spirit University of Kaslik - USEK'),
(41, 'Lebanese German University'),
(42, 'Rafik Hariri University'),
(43, 'Arts, Sciences and Technology University in Lebanon - AUL'),
(44, 'Lebanese French University - ULF'),
(45, 'Modern University for Business and Science - MUBS'),
(46, 'University of Tripoli'),
(47, 'Lebanese Canadian University - LCU'),
(48, 'Lebanese University - Faculty of Sciences'),
(49, 'University of Notre Dame - Louaize'),
(50, 'Islamic University of Lebanon'),
(51, 'Université La Sagesse'),
(52, 'Middle East University - MEU'),
(53, 'Lebanese International Learning Center - LILC'),
(54, 'Al Jinan University'),
(55, 'Lebanese University - Faculty of Engineering'),
(56, 'Lebanese German University - LGU'),
(57, 'Lebanese International University - LIU'),
(58, 'Lebanese University - Faculty of Medicine'),
(59, 'Lebanese University - Faculty of Law and Political Science'),
(60, 'Lebanese University - Faculty of Arts and Humanities');

-- --------------------------------------------------------

--
-- Table structure for table `Skills`
--

CREATE TABLE `Skills` (
  `SkillID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `SkillName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Skills`
--

INSERT INTO `Skills` (`SkillID`, `UserID`, `SkillName`) VALUES
(8, 1, 'Testing'),
(10, 1, 'Performance Optimization'),
(11, 1, 'Database Management'),
(12, 1, 'Programming Languages'),
(13, 1, 'Programming Languages'),
(14, 1, 'Programming Languages'),
(15, 1, 'IoT'),
(16, 5, 'Database Management');

-- --------------------------------------------------------

--
-- Table structure for table `UserGroups`
--

CREATE TABLE `UserGroups` (
  `UserGroupID` int(11) NOT NULL,
  `GroupID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Role` varchar(255) DEFAULT NULL,
  `JoinedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `phone_number` varchar(24) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Industry` varchar(255) DEFAULT NULL,
  `Summary` text,
  `ProfilePictureURL` varchar(255) DEFAULT NULL,
  `random_url` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Name`, `Email`, `birth_date`, `phone_number`, `Password`, `Location`, `Industry`, `Summary`, `ProfilePictureURL`, `random_url`) VALUES
(1, 'Elio123456789', 'elio@gmail.com', '2024-01-03', '12345678', '123', 'jounieh', 'programmer', 'dqwdqwdw', '../uploads/users/oTsxN_Rick.jpeg', '37dKirMpK131lN2'),
(2, 'Elio2', 'elio13333233@gmail.com', '2024-01-16', '12345678', '123', 'jounieh', 'programmer', 'swdq', '../uploads/users/eklK7_Rick.jpeg', 'SiWdgPXokIFD7zX'),
(5, 'Elio', 'elioYes@gmail.com', '2024-01-10', '12345678', '123', 'jounieh', 'programmer', 'dwdw', '../uploads/users/pefON_Rick.jpeg', 'u4WN1Wh3j3ELYi5'),
(6, 'baba', 'baba4@gmail.com', '2024-05-08', '70765834', '1234', 'lebanon', 'Development', 'ascsdcdcdscsdc', '../uploads/users/On6EH_Flexconnect.png', 'eItdlk7cZ7I2ikK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Applications`
--
ALTER TABLE `Applications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `JobID` (`JobID`),
  ADD KEY `ApplicantID` (`ApplicantID`);

--
-- Indexes for table `ApplyJob`
--
ALTER TABLE `ApplyJob`
  ADD PRIMARY KEY (`ApplyID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `JobID` (`JobID`),
  ADD KEY `EmployerID` (`EmployerID`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `PostID` (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Connections`
--
ALTER TABLE `Connections`
  ADD PRIMARY KEY (`ConnectionID`),
  ADD KEY `UserID1` (`UserID1`),
  ADD KEY `UserID2` (`UserID2`);

--
-- Indexes for table `Degree`
--
ALTER TABLE `Degree`
  ADD PRIMARY KEY (`DegreeID`);

--
-- Indexes for table `developerSkills`
--
ALTER TABLE `developerSkills`
  ADD PRIMARY KEY (`developerSkillsID`);

--
-- Indexes for table `Education`
--
ALTER TABLE `Education`
  ADD PRIMARY KEY (`EducationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Endorsements`
--
ALTER TABLE `Endorsements`
  ADD PRIMARY KEY (`EndorsementID`),
  ADD KEY `SkillID` (`SkillID`),
  ADD KEY `EndorsedByUserID` (`EndorsedByUserID`),
  ADD KEY `EndorsedUserID` (`EndorsedUserID`);

--
-- Indexes for table `Experience`
--
ALTER TABLE `Experience`
  ADD PRIMARY KEY (`ExperienceID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `FieldStudy`
--
ALTER TABLE `FieldStudy`
  ADD PRIMARY KEY (`FieldStudyID`);

--
-- Indexes for table `Groups`
--
ALTER TABLE `Groups`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `Jobs`
--
ALTER TABLE `Jobs`
  ADD PRIMARY KEY (`JobID`),
  ADD KEY `EmployerID` (`EmployerID`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `SenderID` (`SenderID`),
  ADD KEY `ReceiverID` (`ReceiverID`);

--
-- Indexes for table `Notification`
--
ALTER TABLE `Notification`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `SenderUserID` (`SenderUserID`),
  ADD KEY `ReceiverUserID` (`ReceiverUserID`);

--
-- Indexes for table `PostInteractions`
--
ALTER TABLE `PostInteractions`
  ADD PRIMARY KEY (`InteractionID`),
  ADD KEY `PostID` (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Recommendations`
--
ALTER TABLE `Recommendations`
  ADD PRIMARY KEY (`RecommendationID`),
  ADD KEY `RecommendedByUserID` (`RecommendedByUserID`),
  ADD KEY `RecommendedUserID` (`RecommendedUserID`);

--
-- Indexes for table `SchoolName`
--
ALTER TABLE `SchoolName`
  ADD PRIMARY KEY (`SchoolNameID`);

--
-- Indexes for table `Skills`
--
ALTER TABLE `Skills`
  ADD PRIMARY KEY (`SkillID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `UserGroups`
--
ALTER TABLE `UserGroups`
  ADD PRIMARY KEY (`UserGroupID`),
  ADD KEY `GroupID` (`GroupID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Applications`
--
ALTER TABLE `Applications`
  MODIFY `ApplicationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ApplyJob`
--
ALTER TABLE `ApplyJob`
  MODIFY `ApplyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `Connections`
--
ALTER TABLE `Connections`
  MODIFY `ConnectionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Degree`
--
ALTER TABLE `Degree`
  MODIFY `DegreeID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `developerSkills`
--
ALTER TABLE `developerSkills`
  MODIFY `developerSkillsID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `Education`
--
ALTER TABLE `Education`
  MODIFY `EducationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Endorsements`
--
ALTER TABLE `Endorsements`
  MODIFY `EndorsementID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Experience`
--
ALTER TABLE `Experience`
  MODIFY `ExperienceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `FieldStudy`
--
ALTER TABLE `FieldStudy`
  MODIFY `FieldStudyID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `Groups`
--
ALTER TABLE `Groups`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Jobs`
--
ALTER TABLE `Jobs`
  MODIFY `JobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `Notification`
--
ALTER TABLE `Notification`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `PostInteractions`
--
ALTER TABLE `PostInteractions`
  MODIFY `InteractionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1181;

--
-- AUTO_INCREMENT for table `Recommendations`
--
ALTER TABLE `Recommendations`
  MODIFY `RecommendationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SchoolName`
--
ALTER TABLE `SchoolName`
  MODIFY `SchoolNameID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `Skills`
--
ALTER TABLE `Skills`
  MODIFY `SkillID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `UserGroups`
--
ALTER TABLE `UserGroups`
  MODIFY `UserGroupID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Applications`
--
ALTER TABLE `Applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`JobID`) REFERENCES `Jobs` (`JobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`ApplicantID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ApplyJob`
--
ALTER TABLE `ApplyJob`
  ADD CONSTRAINT `applyjob_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applyjob_ibfk_2` FOREIGN KEY (`JobID`) REFERENCES `Jobs` (`JobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applyjob_ibfk_3` FOREIGN KEY (`EmployerID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `Posts` (`PostID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Connections`
--
ALTER TABLE `Connections`
  ADD CONSTRAINT `connections_ibfk_1` FOREIGN KEY (`UserID1`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `connections_ibfk_2` FOREIGN KEY (`UserID2`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Education`
--
ALTER TABLE `Education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Endorsements`
--
ALTER TABLE `Endorsements`
  ADD CONSTRAINT `endorsements_ibfk_1` FOREIGN KEY (`SkillID`) REFERENCES `Skills` (`SkillID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `endorsements_ibfk_2` FOREIGN KEY (`EndorsedByUserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `endorsements_ibfk_3` FOREIGN KEY (`EndorsedUserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Experience`
--
ALTER TABLE `Experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Jobs`
--
ALTER TABLE `Jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`EmployerID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`SenderID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ReceiverID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Notification`
--
ALTER TABLE `Notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`SenderUserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`ReceiverUserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PostInteractions`
--
ALTER TABLE `PostInteractions`
  ADD CONSTRAINT `postinteractions_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `Posts` (`PostID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postinteractions_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Recommendations`
--
ALTER TABLE `Recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`RecommendedByUserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recommendations_ibfk_2` FOREIGN KEY (`RecommendedUserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Skills`
--
ALTER TABLE `Skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `UserGroups`
--
ALTER TABLE `UserGroups`
  ADD CONSTRAINT `usergroups_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `Groups` (`GroupID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usergroups_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
