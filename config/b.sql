-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 05, 2024 at 07:58 AM
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
  `ConnectedSince` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ApplyJob`
--

INSERT INTO `ApplyJob` (`ApplyID`, `UserID`, `JobID`, `EmployerID`, `ConnectionStatus`, `ConnectedSince`) VALUES
(5, 5, 71, 1, 'Elio wants to apply for the job you posted. Click <a href=\'ViewJob.php?jobID=71\'>here</a> to view the job and accept the application.', '2024-02-22'),
(6, 2, 71, 1, 'Elio wants to apply for the job you posted. Click <a href=\'ViewJob.php?jobID=71\'>here</a> to view the job and accept the application.', '2024-02-22');

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
(19, 2, 5, 'dwqdwqd', '2024-01-30 19:57:40'),
(46, 2, 5, 'sdcacscsa', '2024-01-30 20:24:13'),
(47, 2, 5, 'wddw', '2024-01-30 20:24:23'),
(56, 1, 5, 'Im GAY', '2024-01-30 21:02:18'),
(74, 2, 1, 'sds', '2024-01-30 21:29:26'),
(91, 14, 1, 'sds', '2024-01-31 10:08:56'),
(93, 14, 1, 'sds', '2024-01-31 10:09:30'),
(100, 1, 5, 'NEW ACCOUNT', '2024-01-31 11:05:31'),
(101, 1, 5, 'DWOJDWQJDWQQDW', '2024-01-31 11:06:04'),
(108, 130, 1, 'sds', '2024-02-07 12:47:23'),
(113, 1, 1, 'elio emo gay\n', '2024-02-21 10:07:11'),
(114, 1, 1, 'sds', '2024-02-21 10:07:47'),
(115, 1, 1, 'efsfsf', '2024-02-21 10:08:00'),
(116, 7, 5, 'hello', '2024-02-21 10:14:25'),
(117, 1, 1, 'ere', '2024-02-27 15:41:12');

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
(10, 1, 'Lebanese University', 'Certificate', 'Data Science', 2000, 2007),
(11, 1, 'Lebanese University', 'Bachelor of Science', 'Computer Science', 2023, 2024),
(12, 1, 'University of Balamand', 'Bachelor of Science', 'Mobile Computing', 2000, 2007),
(13, 1, 'Lebanese University', 'Bachelor of Science', 'Computer Science', 2023, 2024),
(14, 1, 'Lebanese University', 'Bachelor of Science', 'Computer Science', 2023, 2024),
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
(6, 1, 'sdsds', 'sdss', 'sds', '2024-02-04', '2024-01-25', 'sdsdssdsds'),
(7, 1, 'wew', 'wew', 'ew', '2024-01-20', '2024-01-27', 'sdsd'),
(8, 1, 'sds', 'sds', 'sds', '2024-02-15', '2024-02-13', 'sdsds');

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
(70, 1, 'Test1 eliosdsds', 'Test1 2/22/24', 'jounieh', '2024-02-22', '2024-03-01'),
(71, 1, 'wdqd', 'wdqwqd', 'wdqwqd', '2024-02-22', '2024-03-01'),
(72, 1, 'wew', 'wew', 'w', '2024-02-22', '2024-02-14'),
(73, 1, 'Testing file', 'Test file 3/4/2024', 'jounieh', '2024-03-04', '2024-03-28');

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

-- --------------------------------------------------------

--
-- Table structure for table `PostInteractions`
--

CREATE TABLE `PostInteractions` (
  `InteractionID` int(11) NOT NULL,
  `PostID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ReactionStatus` char(10) DEFAULT NULL,
  `InteractionDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PostInteractions`
--

INSERT INTO `PostInteractions` (`InteractionID`, `PostID`, `UserID`, `ReactionStatus`, `InteractionDate`) VALUES
(37, 2, 5, 'dislike', NULL),
(63, 3, 5, 'love', NULL),
(68, 3, 1, 'dislike', NULL),
(85, 1, 5, 'dislike', NULL),
(86, 2, 1, 'love', NULL),
(89, 95, 1, 'love', NULL),
(92, 7, 1, 'like', NULL),
(93, 7, 5, 'like', NULL),
(94, 1, 1, 'love', NULL);

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
(1, 1, 'Test caption', '2024-01-17 10:53:33', 'uploads/posts/pefON_Rick.jpeg'),
(2, 5, 'Test post2', '2024-01-30 17:54:21', 'uploads/posts/pefON_Rick.jpeg'),
(3, 5, 'Test post2', '2024-01-30 17:54:21', 'uploads/posts/pefON_Rick.jpeg'),
(7, 1, 'a', '2024-01-30 21:15:22', 'Peppa.jpeg'),
(14, 1, 'chloeeeeee', '2024-01-30 21:20:37', 'uploads/posts/p0XgD_Screenshot 2024-01-30 at 11.09.31 PM.png'),
(18, 1, 'sdsds', '2024-02-07 09:49:02', 'wri7zuxYs_Screenshot.jpg'),
(23, 1, 'sdsds', '2024-02-07 10:24:54', 'ZFLPCMfv_Screenshot.jpg'),
(34, 1, 'sdsds', '2024-02-07 10:29:33', 'RscQFBmD_Screenshot.jpg'),
(35, 1, 'sdsds', '2024-02-07 10:29:33', 'egRliXTQ_Screenshot.jpg'),
(37, 1, 'sdsds', '2024-02-07 10:29:33', 'Tzt8NN4k_Screenshot.jpg'),
(38, 1, 'sdsds', '2024-02-07 10:29:33', 'GPbylKlD_Screenshot.jpg'),
(39, 1, 'sdsds', '2024-02-07 10:29:33', 'Yjc9YBvp_Screenshot.jpg'),
(40, 1, 'sdsds', '2024-02-07 10:29:33', 'MRLFTtRv_Screenshot.jpg'),
(41, 1, 'sdsds', '2024-02-07 10:29:33', 'Bs5T3EkW_Screenshot.jpg'),
(42, 1, 'sdsds', '2024-02-07 10:29:33', 'uj1I51vp_Screenshot.jpg'),
(43, 1, 'sdsds', '2024-02-07 10:29:34', '3TbW9Prq_Screenshot.jpg'),
(44, 1, 'sdsds', '2024-02-07 10:29:34', '2XGaxdct_Screenshot.jpg'),
(45, 1, 'sdsds', '2024-02-07 10:29:34', 'cAa9N5pX_Screenshot.jpg'),
(46, 1, 'sdsds', '2024-02-07 10:29:34', 'Cu1JU4xI_Screenshot.jpg'),
(47, 1, 'sdsds', '2024-02-07 10:29:34', '45RzPwIq_Screenshot.jpg'),
(48, 1, 'sdsds', '2024-02-07 10:29:34', 'MUoYzOJg_Screenshot.jpg'),
(49, 1, 'sdsds', '2024-02-07 10:29:34', '1kjzy59n_Screenshot.jpg'),
(50, 1, 'sdsds', '2024-02-07 10:29:34', 'jQO0TLRj_Screenshot.jpg'),
(51, 1, 'sdsds', '2024-02-07 10:29:34', 'ETRAF5lM_Screenshot.jpg'),
(52, 1, 'sdsds', '2024-02-07 10:29:34', 'RAIp30kB_Screenshot.jpg'),
(53, 1, 'sdsds', '2024-02-07 10:29:34', 'MPTK5BLk_Screenshot.jpg'),
(54, 1, 'sdsds', '2024-02-07 10:29:34', 'IOMiIIUe_Screenshot.jpg'),
(55, 1, 'sdsds', '2024-02-07 10:29:34', 'o1vc9zN9_Screenshot.jpg'),
(56, 1, 'sdsds', '2024-02-07 10:29:34', '1etNVqH9_Screenshot.jpg'),
(57, 1, 'sdsds', '2024-02-07 10:29:34', '4rLTBP1b_Screenshot.jpg'),
(58, 1, 'sdsds', '2024-02-07 10:29:34', 'I01uzbtL_Screenshot.jpg'),
(59, 1, 'sdsds', '2024-02-07 10:29:34', 'Gr2DJbPY_Screenshot.jpg'),
(60, 1, 'sdsds', '2024-02-07 10:29:34', 'RHCcZViC_Screenshot.jpg'),
(61, 1, 'sdsds', '2024-02-07 10:29:34', 'pifiuYxx_Screenshot.jpg'),
(62, 1, 'sdsds', '2024-02-07 10:29:34', '9MlvcG3Z_Screenshot.jpg'),
(63, 1, 'sdsds', '2024-02-07 10:29:34', 'm3AHpEAH_Screenshot.jpg'),
(64, 1, 'sdsds', '2024-02-07 10:29:34', 'vzchCiIU_Screenshot.jpg'),
(65, 1, 'sdsds', '2024-02-07 10:29:34', 'yMpLQiys_Screenshot.jpg'),
(66, 1, 'sdsds', '2024-02-07 10:29:34', '3CciRvR2_Screenshot.jpg'),
(67, 1, 'sdsds', '2024-02-07 10:29:34', 'bMYWDStm_Screenshot.jpg'),
(68, 1, 'sdsds', '2024-02-07 10:29:34', 'AxuHTzjH_Screenshot.jpg'),
(69, 1, 'sdsds', '2024-02-07 10:29:34', 'xYAi0tjq_Screenshot.jpg'),
(70, 1, 'sdsds', '2024-02-07 10:29:34', 'ORSJ602r_Screenshot.jpg'),
(71, 1, 'sdsds', '2024-02-07 10:29:34', 'tOklb6un_Screenshot.jpg'),
(72, 1, 'sdsds', '2024-02-07 10:29:34', 'kKn9giVp_Screenshot.jpg'),
(73, 1, 'sdsds', '2024-02-07 10:29:34', 'WFV6ik4v_Screenshot.jpg'),
(74, 1, 'sdsds', '2024-02-07 10:29:34', 'szhbav0s_Screenshot.jpg'),
(77, 1, 'sdsds', '2024-02-07 10:29:34', '0gn9muem_Screenshot.jpg'),
(78, 1, 'sdsds', '2024-02-07 10:29:34', '0uRVyqF8_Screenshot.jpg'),
(79, 1, 'sdsds', '2024-02-07 10:29:34', 'CEqpf8v6_Screenshot.jpg'),
(80, 1, 'sdsds', '2024-02-07 10:29:34', '4PzmeRMR_Screenshot.jpg'),
(81, 1, 'sdsds', '2024-02-07 10:29:34', 'BG2pQat7_Screenshot.jpg'),
(82, 1, 'sdsds', '2024-02-07 10:29:34', 'J3yswiKa_Screenshot.jpg'),
(83, 1, 'sdsds', '2024-02-07 10:29:34', '0lcbwGAh_Screenshot.jpg'),
(84, 1, 'sdsds', '2024-02-07 10:29:34', 'Isu7VNzp_Screenshot.jpg'),
(85, 1, 'sdsds', '2024-02-07 10:29:34', 'Qwqc7dbd_Screenshot.jpg'),
(86, 1, 'sdsds', '2024-02-07 10:29:34', 'T6dIAmAG_Screenshot.jpg'),
(87, 1, 'sdsds', '2024-02-07 10:29:34', 'wum8K760_Screenshot.jpg'),
(88, 1, 'sdsds', '2024-02-07 10:29:34', 'GW08fvfY_Screenshot.jpg'),
(89, 1, 'sdsds', '2024-02-07 10:29:34', '0wBljDaG_Screenshot.jpg'),
(90, 1, 'sdsds', '2024-02-07 10:29:34', 'pWzk6aTx_Screenshot.jpg'),
(91, 1, 'sdsds', '2024-02-07 10:29:34', 'ybWnAFPT_Screenshot.jpg'),
(92, 1, 'sdsds', '2024-02-07 10:29:34', 'rUH8UziV_Screenshot.jpg'),
(93, 1, 'sdsds', '2024-02-07 10:29:34', '0ugOvb1k_Screenshot.jpg'),
(94, 1, 'sdsds', '2024-02-07 10:29:34', 'o1kdGXpz_Screenshot.jpg'),
(95, 1, 'sdsds', '2024-02-07 10:29:34', 'GcBFII1f_Screenshot.jpg'),
(96, 1, 'sdsds', '2024-02-07 10:29:34', 'dkdBXEo1_Screenshot.jpg'),
(97, 1, 'sdsds', '2024-02-07 10:29:34', 'j5vbkpYF_Screenshot.jpg'),
(98, 1, 'sdsds', '2024-02-07 10:29:34', 'KcB2UIZV_Screenshot.jpg'),
(99, 1, 'sdsds', '2024-02-07 10:29:35', 'JxNqPvcp_Screenshot.jpg'),
(100, 1, 'sdsds', '2024-02-07 10:29:35', 'fyTAD6ZX_Screenshot.jpg'),
(101, 1, 'sdsds', '2024-02-07 10:29:35', 'BW2rRAjh_Screenshot.jpg'),
(102, 1, 'sdsds', '2024-02-07 10:29:35', 'Pxrs2iKR_Screenshot.jpg'),
(103, 1, 'sdsds', '2024-02-07 10:29:35', 'ZldVPMKq_Screenshot.jpg'),
(104, 1, 'sdsds', '2024-02-07 10:29:35', 'L8US76oB_Screenshot.jpg'),
(105, 1, 'sdsds', '2024-02-07 10:29:35', 'C6gEttXm_Screenshot.jpg'),
(107, 1, 'sdsds', '2024-02-07 10:29:35', '9zlmGMqn_Screenshot.jpg'),
(108, 1, 'sdsds', '2024-02-07 10:29:35', 'Er1kSIjs_Screenshot.jpg'),
(109, 1, 'sdsds', '2024-02-07 10:29:35', 'uo0iTrZl_Screenshot.jpg'),
(110, 1, 'sdsds', '2024-02-07 10:29:35', 'NyDPa32m_Screenshot.jpg'),
(111, 1, 'sdsds', '2024-02-07 10:29:35', 'NyYZ7xZ5_Screenshot.jpg'),
(112, 1, 'sdsds', '2024-02-07 10:29:35', 'ZhTST0sx_Screenshot.jpg'),
(113, 1, 'sdsds', '2024-02-07 10:29:35', 'cREA34PO_Screenshot.jpg'),
(114, 1, 'sdsds', '2024-02-07 10:29:35', 'r3hgs2B5_Screenshot.jpg'),
(115, 1, 'sdsds', '2024-02-07 10:29:35', 'xgmqxcEe_Screenshot.jpg'),
(116, 1, 'sdsds', '2024-02-07 10:29:35', 'rffUmZMd_Screenshot.jpg'),
(117, 1, 'sdsds', '2024-02-07 10:29:35', 'HiiVQTzh_Screenshot.jpg'),
(118, 1, 'sdsds', '2024-02-07 10:29:35', '1OFMD1i2_Screenshot.jpg'),
(119, 1, 'sdsds', '2024-02-07 10:29:35', '9tZwoHNW_Screenshot.jpg'),
(120, 1, 'sdsds', '2024-02-07 10:29:35', '41FXd5kz_Screenshot.jpg'),
(121, 1, 'sdsds', '2024-02-07 10:29:35', 'SKo6bjbA_Screenshot.jpg'),
(122, 1, 'sdsds', '2024-02-07 10:29:35', '9BxIAV0t_Screenshot.jpg'),
(123, 1, 'sdsds', '2024-02-07 10:29:35', 'l7SC582b_Screenshot.jpg'),
(124, 1, 'sdsds', '2024-02-07 10:29:35', 'RGYy9XrQ_Screenshot.jpg'),
(125, 1, 'sdsds', '2024-02-07 10:29:35', 'InyRcIHs_Screenshot.jpg'),
(126, 1, 'sdsds', '2024-02-07 10:29:35', 'GF4LMAlK_Screenshot.jpg'),
(127, 1, 'sdsds', '2024-02-07 10:29:35', 'xzMvwewZ_Screenshot.jpg'),
(128, 1, 'sdsds', '2024-02-07 10:29:35', 'D26OM8fr_Screenshot.jpg'),
(129, 1, 'sdsds', '2024-02-07 10:29:35', 'VTwfibNA_Screenshot.jpg'),
(130, 1, 'sdsds', '2024-02-07 10:29:35', 'sWedY3BC_Screenshot.jpg'),
(131, 1, 'sdsds', '2024-02-07 10:29:35', 'bJZRBmnB_Screenshot.jpg'),
(132, 1, 'sdsds', '2024-02-07 10:29:35', '7DbReeQW_Screenshot.jpg'),
(133, 1, 'sdsds', '2024-02-07 10:29:35', 'aQPYubQA_Screenshot.jpg'),
(134, 1, 'sdsds', '2024-02-07 10:29:35', 'mAivTTiT_Screenshot.jpg'),
(135, 1, 'sdsds', '2024-02-07 10:29:35', 'wxxetCg6_Screenshot.jpg'),
(136, 1, 'sdsds', '2024-02-07 10:29:35', 'Kj5XedHH_Screenshot.jpg'),
(137, 1, 'sdsds', '2024-02-07 10:29:35', 'waz6oAnG_Screenshot.jpg'),
(138, 1, 'sdsds', '2024-02-07 10:29:35', 'WNgMnDIU_Screenshot.jpg'),
(139, 1, 'sdsds', '2024-02-07 10:29:35', 'urFdO9jL_Screenshot.jpg'),
(140, 1, 'sdsds', '2024-02-07 10:29:35', 'Cj0lvNDl_Screenshot.jpg'),
(141, 1, 'sdsds', '2024-02-07 10:29:35', 'g5g65p39_Screenshot.jpg'),
(142, 1, 'sdsds', '2024-02-07 10:29:35', 'WjX66EmH_Screenshot.jpg'),
(143, 1, 'sdsds', '2024-02-07 10:29:35', 'Hgduw7xb_Screenshot.jpg'),
(144, 1, 'sdsds', '2024-02-07 10:29:35', 'uGWWaPsH_Screenshot.jpg'),
(145, 1, 'sdsds', '2024-02-07 10:29:35', 'mgmiOglD_Screenshot.jpg'),
(146, 1, 'sdsds', '2024-02-07 10:29:35', 'TqqrM4l4_Screenshot.jpg'),
(147, 1, 'sdsds', '2024-02-07 10:29:35', 'zp1qEmar_Screenshot.jpg'),
(148, 1, 'sdsds', '2024-02-07 10:29:35', 'c2rsb2BM_Screenshot.jpg'),
(149, 1, 'sdsds', '2024-02-07 10:29:35', '8hUmgktb_Screenshot.jpg'),
(150, 1, 'sdsds', '2024-02-07 10:29:35', 'x6bIHy4a_Screenshot.jpg'),
(151, 1, 'sdsds', '2024-02-07 10:29:35', 'y2JSqmET_Screenshot.jpg'),
(152, 1, 'sdsds', '2024-02-07 10:29:35', '2KldxWw4_Screenshot.jpg'),
(153, 1, 'sdsds', '2024-02-07 10:29:35', 'toZwxuud_Screenshot.jpg'),
(154, 1, 'sdsds', '2024-02-07 10:29:35', 'zipdk9vV_Screenshot.jpg'),
(155, 1, 'sdsds', '2024-02-07 10:29:35', '83bSn7rY_Screenshot.jpg'),
(156, 1, 'sdsds', '2024-02-07 10:29:35', 'OEjlUk79_Screenshot.jpg'),
(157, 1, 'sdsds', '2024-02-07 10:29:36', 'tCvqaKUS_Screenshot.jpg'),
(158, 1, 'sdsds', '2024-02-07 10:29:36', 'JMlG2Ghs_Screenshot.jpg'),
(159, 1, 'sdsds', '2024-02-07 10:29:36', 'ZQTnRPjh_Screenshot.jpg'),
(160, 1, 'sdsds', '2024-02-07 10:29:36', '2z4z51g4_Screenshot.jpg'),
(161, 1, 'sdsds', '2024-02-07 10:29:36', 'j13w5TTE_Screenshot.jpg'),
(162, 1, 'sdsds', '2024-02-07 10:29:36', '8BYw62g4_Screenshot.jpg'),
(163, 1, 'sdsds', '2024-02-07 10:29:36', 'KJiQtTZT_Screenshot.jpg'),
(164, 1, 'sdsds', '2024-02-07 10:29:36', 'J9pG0NeI_Screenshot.jpg'),
(165, 1, 'sdsds', '2024-02-07 10:29:36', 'V6zfSnWA_Screenshot.jpg'),
(166, 1, 'sdsds', '2024-02-07 10:29:36', 'MOGEOgLg_Screenshot.jpg'),
(167, 1, 'sdsds', '2024-02-07 10:29:36', 'zpZ19ZeW_Screenshot.jpg'),
(168, 1, 'sdsds', '2024-02-07 10:29:36', 'vRx9rAYH_Screenshot.jpg'),
(169, 1, 'sdsds', '2024-02-07 10:29:36', 'b2DZegm1_Screenshot.jpg'),
(170, 1, 'sdsds', '2024-02-07 10:29:36', 'HNzSKe35_Screenshot.jpg'),
(171, 1, 'sdsds', '2024-02-07 10:29:36', '9Tb3UeGj_Screenshot.jpg'),
(172, 1, 'sdsds', '2024-02-07 10:29:36', 'zhwJXhlV_Screenshot.jpg'),
(173, 1, 'sdsds', '2024-02-07 10:29:36', 'lqYw8EV7_Screenshot.jpg'),
(174, 1, 'sdsds', '2024-02-07 10:29:36', 'lhrQhXTK_Screenshot.jpg'),
(175, 1, 'sdsds', '2024-02-07 10:29:36', 'B37T2qpx_Screenshot.jpg'),
(176, 1, 'sdsds', '2024-02-07 10:29:36', 'TWV6CXhQ_Screenshot.jpg'),
(177, 1, 'sdsds', '2024-02-07 10:29:36', 'SwVoqyX2_Screenshot.jpg'),
(178, 1, 'sdsds', '2024-02-07 10:29:36', '9QSdHq6t_Screenshot.jpg'),
(179, 1, 'sdsds', '2024-02-07 10:29:36', 'r5B8ela3_Screenshot.jpg'),
(180, 1, 'sdsds', '2024-02-07 10:29:36', '8CuthcHj_Screenshot.jpg'),
(181, 1, 'sdsds', '2024-02-07 10:29:36', 'EzpZ4P8M_Screenshot.jpg'),
(182, 1, 'sdsds', '2024-02-07 10:29:36', 'svEeBKzL_Screenshot.jpg'),
(183, 1, 'sdsds', '2024-02-07 10:29:36', 'mvOitY0d_Screenshot.jpg'),
(184, 1, 'sdsds', '2024-02-07 10:29:36', '0btso08J_Screenshot.jpg'),
(185, 1, 'sdsds', '2024-02-07 10:29:36', 'ErlIi3iJ_Screenshot.jpg'),
(186, 1, 'sdsds', '2024-02-07 10:29:36', 'rqitwC8f_Screenshot.jpg'),
(187, 1, 'sdsds', '2024-02-07 10:29:36', 'agFBD08j_Screenshot.jpg'),
(188, 1, 'sdsds', '2024-02-07 10:29:36', 'HDO8F2yZ_Screenshot.jpg'),
(189, 1, 'sdsds', '2024-02-07 10:29:36', 'Uv1qCYDz_Screenshot.jpg'),
(190, 1, 'sdsds', '2024-02-07 10:29:36', 'bevOdxpo_Screenshot.jpg'),
(191, 1, 'sdsds', '2024-02-07 10:29:36', 'kfauWPMu_Screenshot.jpg'),
(192, 1, 'sdsds', '2024-02-07 10:29:36', 'scirODoD_Screenshot.jpg'),
(193, 1, 'sdsds', '2024-02-07 10:29:36', 'ZRNP5m2v_Screenshot.jpg'),
(194, 1, 'sdsds', '2024-02-07 10:29:36', 'MhUHmPty_Screenshot.jpg'),
(195, 1, 'sdsds', '2024-02-07 10:29:36', 'j7Rn8svU_Screenshot.jpg'),
(196, 1, 'sdsds', '2024-02-07 10:29:36', 'FrgUMkA7_Screenshot.jpg'),
(197, 1, 'sdsds', '2024-02-07 10:29:36', '8Xy1pn6b_Screenshot.jpg'),
(198, 1, 'sdsds', '2024-02-07 10:29:36', '9Xfj9Dfc_Screenshot.jpg'),
(199, 1, 'sdsds', '2024-02-07 10:29:36', 'Dq6ZboxX_Screenshot.jpg'),
(200, 1, 'sdsds', '2024-02-07 10:29:36', 'aO3k8WfF_Screenshot.jpg'),
(201, 1, 'sdsds', '2024-02-07 10:29:36', 'jmk86fOV_Screenshot.jpg'),
(202, 1, 'sdsds', '2024-02-07 10:29:36', 'PIWQrdFf_Screenshot.jpg'),
(203, 1, 'sdsds', '2024-02-07 10:29:36', 'ywIcQHXv_Screenshot.jpg'),
(204, 1, 'sdsds', '2024-02-07 10:29:36', 'fK5G0H7D_Screenshot.jpg'),
(205, 1, 'sdsds', '2024-02-07 10:29:36', 'BQUzUpHj_Screenshot.jpg');

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
(2, 1, 'Security'),
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
(1, 'Elio123456789', 'elio@gmail.com', '2024-01-03', '12345678', '123', 'jounieh', 'programmer', 'dqwdqwdw', 'uploads/users/oTsxN_Rick.jpeg', '37dKirMpK131lN2'),
(2, 'Elio2', 'elio13333233@gmail.com', '2024-01-16', '12345678', '123', 'jounieh', 'programmer', 'swdq', 'uploads/users/eklK7_Rick.jpeg', 'SiWdgPXokIFD7zX'),
(5, 'Elio', 'elioYes@gmail.com', '2024-01-10', '12345678', '123', 'jounieh', 'programmer', 'dwdw', '../uploads/users/pefON_Rick.jpeg', 'u4WN1Wh3j3ELYi5');

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
  MODIFY `ApplyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

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
  MODIFY `ExperienceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `JobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PostInteractions`
--
ALTER TABLE `PostInteractions`
  MODIFY `InteractionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

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
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Applications`
--
ALTER TABLE `Applications`
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`ApplicantID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `ApplyJob`
--
ALTER TABLE `ApplyJob`
  ADD CONSTRAINT `applyjob_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `applyjob_ibfk_2` FOREIGN KEY (`JobID`) REFERENCES `Jobs` (`JobID`),
  ADD CONSTRAINT `applyjob_ibfk_3` FOREIGN KEY (`EmployerID`) REFERENCES `Jobs` (`EmployerID`);

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `Posts` (`PostID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Connections`
--
ALTER TABLE `Connections`
  ADD CONSTRAINT `connections_ibfk_1` FOREIGN KEY (`UserID1`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `connections_ibfk_2` FOREIGN KEY (`UserID2`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Education`
--
ALTER TABLE `Education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Endorsements`
--
ALTER TABLE `Endorsements`
  ADD CONSTRAINT `endorsements_ibfk_1` FOREIGN KEY (`SkillID`) REFERENCES `Skills` (`SkillID`),
  ADD CONSTRAINT `endorsements_ibfk_2` FOREIGN KEY (`EndorsedByUserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `endorsements_ibfk_3` FOREIGN KEY (`EndorsedUserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Experience`
--
ALTER TABLE `Experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Jobs`
--
ALTER TABLE `Jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`EmployerID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`SenderID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ReceiverID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `PostInteractions`
--
ALTER TABLE `PostInteractions`
  ADD CONSTRAINT `postinteractions_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `Posts` (`PostID`),
  ADD CONSTRAINT `postinteractions_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Recommendations`
--
ALTER TABLE `Recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`RecommendedByUserID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `recommendations_ibfk_2` FOREIGN KEY (`RecommendedUserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `Skills`
--
ALTER TABLE `Skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

--
-- Constraints for table `UserGroups`
--
ALTER TABLE `UserGroups`
  ADD CONSTRAINT `usergroups_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `Groups` (`GroupID`),
  ADD CONSTRAINT `usergroups_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
