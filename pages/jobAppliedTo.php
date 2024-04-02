<?php

include "../config/db.php";

$selectJobAppliedTo = "SELECT u.*, j.*, a.* FROM Users AS u
                       INNER JOIN Jobs AS j ON u.UserID = j.EmployerID 
                       INNER JOIN ApplyJob AS a ON j.JobID = a.JobID 
                       WHERE a.UserID = $_SESSION[user_id]";
$resultJobAppliedTo = $conn->query($selectJobAppliedTo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Job Applications</title>

    <style>
        #jobContainer {
            display: flex;
            justify-content: flex-start;
            gap: 20%;
            padding: 20px;
        }

        #asideNav div:hover {
            cursor: pointer;
        }
    </style>

</head>
<body>

<section id="jobContainer">
    <aside id="asideNav">
        <div><a href="jobs.php">Back To Jobs</a></div>
        <div><a href="User_job_post.php">My Posts</a></div>
        <div><a href="PostJob.php">Post a Job</a></div>
        <div><a href="PeopleApplied.php">People Who Applied to My Jobs</a></div>
        <div>Jobs Applied To</div>
    </aside>

    <article id="JobApplied">
        <?php
        if ($resultJobAppliedTo->num_rows > 0) {
            while ($rowJobAppliedTo = $resultJobAppliedTo->fetch_assoc()) {
                ?>
                <div>
                    <div>
                        <div>
                            <img src="<?php echo $rowJobAppliedTo['ProfilePictureURL']; ?>" alt="Profile"
                                 class="mr-3 rounded-circle">
                            <div>
                                <h5><?php echo $rowJobAppliedTo['Name']; ?></h5>
                                <p><?php echo $rowJobAppliedTo['Title']; ?></p>
                                <p>Status: <?php echo $rowJobAppliedTo['STATUS']; ?></p>
                            </div>
                        </div>

                        <div>
                            <p><?php echo $rowJobAppliedTo['PostedDate']; ?></p>
                            <p><?php echo $rowJobAppliedTo['ApplicationDeadline']; ?></p>
                            <p><?php echo $rowJobAppliedTo['Location']; ?></p>
                        </div>
                    </div>

                    <div>
                        <p><?php echo $rowJobAppliedTo['Description']; ?></p>
                    </div>

                    <div>
                        <a href="#">Contact</a>
                    </div>
                </div>
                <br><br><br>
                <?php
            }
        }
        ?>
    </article>
</section>

</body>
</html>
