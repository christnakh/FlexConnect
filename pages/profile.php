<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select user information
$userSQL = "SELECT * FROM Users WHERE UserID = $userID";
$userResult = $conn->query($userSQL);

if ($userResult->num_rows == 1) {
    $user = $userResult->fetch_assoc();
} else {
    echo "Error fetching user information";
    exit();
}

// Select skills information
echo "<h1>Skills</h1>";
$skillsSQL = "SELECT * FROM Skills WHERE UserID = $userID";
$skillsResult = $conn->query($skillsSQL);

if ($skillsResult->num_rows > 0) {
    $skills = $skillsResult->fetch_assoc();
    // Fetch other data as needed
} else {
    $skills = array(); // Empty array if no skills found
}

// Select posts information
echo "<h1>Posts</h1>";
$postsSQL = "SELECT * FROM Posts WHERE UserID = $userID";
$postsResult = $conn->query($postsSQL);

if ($postsResult->num_rows > 0) {
    $posts = $postsResult->fetch_assoc();
    // Fetch other data as needed
} else {
    $posts = array(); // Empty array if no posts found
}


// Select experience information
echo "<h1>Experience</h1>";
$experienceSQL = "SELECT * FROM Experience WHERE UserID = $userID";
$experienceResult = $conn->query($experienceSQL);

if ($experienceResult->num_rows > 0) {
    $experience = $experienceResult->fetch_assoc();
    // Fetch other data as needed
} else {
    $experience = array(); // Empty array if no experience found
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <!-- Display user information -->
    <h1>User Profile</h1>
    <p>Name: <?php echo $user['Name']; ?></p>
    <p>Email: <?php echo $user['Email']; ?></p>
    <!-- Display other information from $skills, $posts, $experience, $endorsements arrays as needed -->

    <p><a href="edit_experience.php">Edit Experience</a></p>
    <p><a href="edit_education.php">Edit Education</a></p>
    <p><a href="edit_skills.php">Edit Skills</a></p>

    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
    <a href="/">Back home</a>
</body>
</html>
