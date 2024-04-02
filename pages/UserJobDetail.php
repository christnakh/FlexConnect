<?php
include "../config/db.php";

// Assuming the random_url is passed as a parameter in the URL
$randomUrl = $_GET['url'];

// Retrieve the UserID based on the random_url
$selectUserId = "SELECT UserID FROM Users WHERE random_url = '$randomUrl'";
$resultUserId = $conn->query($selectUserId);

if ($resultUserId->num_rows > 0) {
    $rowUserId = $resultUserId->fetch_assoc();
    $userId = $rowUserId['UserID'];

    // Retrieve skills for the user
    $selectSkills = "SELECT * FROM Skills WHERE UserID = $userId";
    $resultSkills = $conn->query($selectSkills);

    // Retrieve education for the user
    $selectEducation = "SELECT * FROM Education WHERE UserID = $userId";
    $resultEducation = $conn->query($selectEducation);

    // Display skills
    if ($resultSkills->num_rows > 0) {
        echo '<div><h3>Skills:</h3><ul>';
        while ($rowSkills = $resultSkills->fetch_assoc()) {
            echo '<li>' . $rowSkills['SkillName'] . '</li>';
        }
        echo '</ul></div>';
    } else {
        echo '<div>No skills found for the user.</div>';
    }

    // Display education
    if ($resultEducation->num_rows > 0) {
        echo '<div><h3>Education:</h3><ul>';
        while ($rowEducation = $resultEducation->fetch_assoc()) {
            echo '<li>' . $rowEducation['Degree'] . ' in ' . $rowEducation['FieldOfStudy'] . ' from ' . $rowEducation['SchoolName'] . '</li>';
        }
        echo '</ul></div>';
    } else {
        echo '<div>No education found for the user.</div>';
    }
} else {
    echo 'User not found.';
}
?>
