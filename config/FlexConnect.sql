-- Users Table
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255),
    Email VARCHAR(255) UNIQUE,
    Password VARCHAR(255),
    Location VARCHAR(255),
    Industry VARCHAR(255),
    Summary TEXT,
    ProfilePictureURL VARCHAR(255),
    random_url char(15)
);

-- Education Table
CREATE TABLE Education (
    EducationID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    SchoolName VARCHAR(255),
    Degree VARCHAR(255),
    FieldOfStudy VARCHAR(255),
    StartYear YEAR,
    EndYear YEAR,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Experience Table
CREATE TABLE Experience (
    ExperienceID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    CompanyName VARCHAR(255),
    Title VARCHAR(255),
    Location VARCHAR(255),
    StartDate DATE,
    EndDate DATE,
    Description TEXT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Skills Table
CREATE TABLE Skills (
    SkillID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    SkillName VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Connections Table
CREATE TABLE Connections (
    ConnectionID INT AUTO_INCREMENT PRIMARY KEY,
    UserID1 INT,
    UserID2 INT,
    ConnectionStatus VARCHAR(255),
    ConnectedSince DATE,
    FOREIGN KEY (UserID1) REFERENCES Users(UserID),
    FOREIGN KEY (UserID2) REFERENCES Users(UserID)
);

-- Jobs Table
CREATE TABLE Jobs (
    JobID INT AUTO_INCREMENT PRIMARY KEY,
    EmployerID INT,
    Title VARCHAR(255),
    Description TEXT,
    Location VARCHAR(255),
    PostedDate DATE,
    ApplicationDeadline DATE,
    FOREIGN KEY (EmployerID) REFERENCES Users(UserID)
);

-- Applications Table
CREATE TABLE Applications (
    ApplicationID INT AUTO_INCREMENT PRIMARY KEY,
    JobID INT,
    ApplicantID INT,
    ApplicationDate DATE,
    Status VARCHAR(255),
    FOREIGN KEY (JobID) REFERENCES Jobs(JobID),
    FOREIGN KEY (ApplicantID) REFERENCES Users(UserID)
);

-- Posts Table
CREATE TABLE Posts (
    PostID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    Content TEXT,
    PostDate DATETIME,
    ImageURL VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Messages Table
CREATE TABLE Messages (
    MessageID INT AUTO_INCREMENT PRIMARY KEY,
    SenderID INT,
    ReceiverID INT,
    MessageText TEXT,
    Timestamp DATETIME,
    FOREIGN KEY (SenderID) REFERENCES Users(UserID),
    FOREIGN KEY (ReceiverID) REFERENCES Users(UserID)
);

-- Groups Table
CREATE TABLE Groups (
    GroupID INT AUTO_INCREMENT PRIMARY KEY,
    GroupName VARCHAR(255),
    Description TEXT
);

-- UserGroups Table
CREATE TABLE UserGroups (
    UserGroupID INT AUTO_INCREMENT PRIMARY KEY,
    GroupID INT,
    UserID INT,
    Role VARCHAR(255),
    JoinedDate DATE,
    FOREIGN KEY (GroupID) REFERENCES Groups(GroupID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Endorsements Table
CREATE TABLE Endorsements (
    EndorsementID INT AUTO_INCREMENT PRIMARY KEY,
    SkillID INT,
    EndorsedByUserID INT,
    EndorsedUserID INT,
    FOREIGN KEY (SkillID) REFERENCES Skills(SkillID),
    FOREIGN KEY (EndorsedByUserID) REFERENCES Users(UserID),
    FOREIGN KEY (EndorsedUserID) REFERENCES Users(UserID)
);

-- Recommendations Table
CREATE TABLE Recommendations (
    RecommendationID INT AUTO_INCREMENT PRIMARY KEY,
    RecommendedByUserID INT,
    RecommendedUserID INT,
    RecommendationText TEXT,
    Date DATE,
    FOREIGN KEY (RecommendedByUserID) REFERENCES Users(UserID),
    FOREIGN KEY (RecommendedUserID) REFERENCES Users(UserID)
);
