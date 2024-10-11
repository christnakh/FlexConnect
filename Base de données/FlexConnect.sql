-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 15, 2024 at 07:09 AM
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
  MODIFY `ApplyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

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
  MODIFY `JobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `Notification`
--
ALTER TABLE `Notification`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `PostInteractions`
--
ALTER TABLE `PostInteractions`
  MODIFY `InteractionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3679;

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
