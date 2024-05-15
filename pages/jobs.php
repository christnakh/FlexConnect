<?php
include "../config/db.php";

$currentDate = date("Y-m-d");

$selectJob = "SELECT u.*, j.* FROM Users as u INNER JOIN Jobs as j on u.UserID = j.EmployerID WHERE EmployerID <> $_SESSION[user_id] AND j.PostedDate <= '$currentDate' AND j.ApplicationDeadline >= '$currentDate'";
$resultJob = $conn -> query($selectJob);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
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
        #Jobs {
            width: 90%;
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        .job {
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
            word-wrap: break-word;
        }

        @media (max-width: 768px) {
            #jobContainer {
                flex-direction: column;
            }
            #asideNav {
                width: 100%;
                margin-bottom: 20px;
            }
            #Jobs {
                width: 100%;
            }
            .job {
                flex-direction: column;
            }
            .job img {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .job-details h5 {
                font-size: 16px;
            }
            .job-details .posted-date,
            .job-details p {
                font-size: 14px;
            }
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
    </style>
</head>
<body>
    <section id="jobContainer">
        <aside id="asideNav">
            <div>
                <div><a href="../index.php"><ion-icon name="arrow-back-outline"></ion-icon> Home</a></div>
                <div><a href="User_job_post.php">My Job Posts</a></div>
            </div>
        </aside>
        <article id="Jobs">
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
                            <br>
                            <div class="job-description">
                                <p><?php echo $row['Description']; ?></p>
                            </div>
                            <div class="actions">
                                <a href="#">Contact</a>
                                <a href="apply_job.php?jobID=<?php echo $row['JobID']; ?>&employerID=<?php echo $row['EmployerID']; ?>">Apply</a>
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
