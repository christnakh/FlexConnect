<?php

include "../config/db.php";

$selectJob = "SELECT u.*, j.* FROM Users as u INNER JOIN Jobs as j on u.UserID = j.EmployerID WHERE j.EmployerID = $_SESSION[user_id]";
$resultJob = $conn -> query($selectJob);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Job Posts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            display: flex; 
            flex-direction: column; 
        }

        #jobContainer {
            display: flex;
            justify-content: flex-start;
        }

        #asideNav {
            width: 200px;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        #asideNav a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 15px;
            border-radius: 4px;
        }

        #asideNav a:hover {
            background-color: #495057;
        }



        #MyJobs {
            width: 90%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }

        .job {
            width: 100%;
            display: flex;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .job img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .job-details {
            flex-grow: 1;
        }

        .job-details h5 {
            color: #007bff;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .job-details .posted-date {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .job-description {
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .job .actions {
            margin-top: 10px;
        }

        .job .actions a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }

        
        .job-details p {
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .job-details p strong {
            font-weight: bold;
        }

        .job-details .job-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .job-details .job-info p {
            margin-bottom: 0;
        }

        .currentPage a{
            background-color: #495057;
        }
    </style>
</head>
<body>
    
<section id="jobContainer">
    <aside id="asideNav"> <br>
        <div><a href="jobs.php">Back to Jobs</a></div>
        <div class='currentPage'><a>My Posts</a></div>
        <div><a href="PostJob.php">Post a Job</a></div>
        <div><a href="PeopleApplied.php">People Applied to My Jobs</a></div>
        <div><a href="jobAppliedTo.php">Jobs I've Applied to</a></div>
    </aside>

    <article id="MyJobs">
        <?php
        if ($resultJob->num_rows > 0) {
            while ($row = $resultJob->fetch_assoc()) {
                ?>
                <div class="job">
                    <img src="<?php echo $row['ProfilePictureURL']; ?>" alt="Profile">
                    <div class="job-details">
                        <div class="job-info">
                            <h5><?php echo $row['Name']; ?></h5>
                            <div class="posted-date"><?php echo $row['PostedDate']; ?> / <?php echo $row['ApplicationDeadline']; ?></div>
                        </div>
                        <div class="job-info">
                            <p><?php echo $row['Title']; ?></p>
                            <p><?php echo $row['Location']; ?></p>
                        </div>
                        <div class="job-description">
                            <p><?php echo $row['Description']; ?></p>
                        </div>
                        <div class="actions">
                            <a href="delete_job_post.php?job_id=<?php echo $row['JobID']; ?>">Delete Post</a>
                            <a href="update_job_post.php?job_id=<?php echo $row['JobID']; ?>">Edit Post</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No job posts available.</p>";
        }
        ?>
    </article>
</section>
</body>
</html>
