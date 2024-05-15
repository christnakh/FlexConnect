<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h3 {
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 5px;
        }

        .message {
            font-style: italic;
            color: #888;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>User Profile</h1>

    <?php
    include "../config/db.php";

  
    $randomUrl = $_GET['url'];

  
    $selectUserId = "SELECT UserID FROM Users WHERE random_url = '$randomUrl'";
    $resultUserId = $conn->query($selectUserId);

    if ($resultUserId->num_rows > 0) {
        $rowUserId = $resultUserId->fetch_assoc();
        $userId = $rowUserId['UserID'];

      
        $selectSkills = "SELECT * FROM Skills WHERE UserID = $userId";
        $resultSkills = $conn->query($selectSkills);

        if ($resultSkills->num_rows > 0) {
            echo '<div class="section"><h3>Skills:</h3><ul>';
            while ($rowSkills = $resultSkills->fetch_assoc()) {
                echo '<li>' . htmlspecialchars($rowSkills['SkillName']) . '</li>';
            }
            echo '</ul></div>';
        } else {
            echo '<div class="section"><div class="message">No skills found for the user.</div></div>';
        }

        $selectEducation = "SELECT * FROM Education WHERE UserID = $userId";
        $resultEducation = $conn->query($selectEducation);

        if ($resultEducation->num_rows > 0) {
            echo '<div class="section"><h3>Education:</h3><ul>';
            while ($rowEducation = $resultEducation->fetch_assoc()) {
                echo '<li>' . htmlspecialchars($rowEducation['Degree']) . ' in ' . htmlspecialchars($rowEducation['FieldOfStudy']) . ' from ' . htmlspecialchars($rowEducation['SchoolName']) . '</li>';
            }
            echo '</ul></div>';
        } else {
            echo '<div class="section"><div class="message">No education found for the user.</div></div>';
        }
    } else {
        echo '<div class="section"><div class="message">User not found.</div></div>';
    }
    ?>

    <a href="javascript:history.back()" class="back-button">Back</a>

</body>
</html>
