<?php

include "../config/db.php";

$selectJobPeopleApplied = "
    SELECT j.*, a.*, u.Name, u.ProfilePictureURL, u.random_url
    FROM Jobs AS j
    LEFT JOIN ApplyJob AS a ON j.JobID = a.JobID
    LEFT JOIN Users AS u ON a.UserID = u.UserID
    WHERE j.EmployerID = $_SESSION[user_id]
    ORDER BY j.JobID, a.ApplyID
";
$resultJobPeopleApplied = $conn->query($selectJobPeopleApplied);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Post job</title>
</head>
<body>

<section>
    <article id="PeopleApplied">
        <?php
        if ($resultJobPeopleApplied->num_rows > 0) {
            $currentJobID = null;

            while ($rowJobPeopleApplied = $resultJobPeopleApplied->fetch_assoc()) {
                if ($rowJobPeopleApplied['JobID'] != $currentJobID) {
                    // Display job information
                    if ($currentJobID !== null) {
                        echo '</ul>';
                        echo '</div>';
                        echo '<br><br><br>';
                    }

                    echo '<div>';
                    echo '<div>';
                    echo '<div>';
                    echo '<div>';
                    echo '<h5>' . $rowJobPeopleApplied['Name'] . '</h5>';
                    echo '<p>' . $rowJobPeopleApplied['Title'] . '</p>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div>';
                    echo '<p>' . $rowJobPeopleApplied['PostedDate'] . '</p>';
                    echo '<p>' . $rowJobPeopleApplied['Location'] . '</p>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div>';
                    echo '<p>' . $rowJobPeopleApplied['Description'] . '</p>';
                    echo '</div>';

                    echo '<div>';
                    echo '<h6>People who applied to this job:</h6>';
                    echo '<ul>';
                }

                // Display applicant information
                if ($rowJobPeopleApplied['ApplyID'] !== null) {
                    echo '<li style="list-style-type: none;">';
                    echo '<img src="' . $rowJobPeopleApplied['ProfilePictureURL'] . '" alt="Applicant Profile" class="mr-3 rounded-circle">';
                    echo '<span>' . $rowJobPeopleApplied['Name'] . '</span>';
                    echo '<span><a href="UserJobDetail.php?url=' . $rowJobPeopleApplied['random_url'] . '">Details</a></span>';
                    echo '</li> <br><br><br>';
                }

                $currentJobID = $rowJobPeopleApplied['JobID'];
            }

            // Check if there are any remaining applicants for the last job
            if ($currentJobID !== null) {
                echo '</ul>';
                echo '</div>';
                echo '<br><br><br>';
            }
        }
        ?>
    </article>
</section>

</body>
</html>
