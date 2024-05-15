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
    <title>Jobs Applied To</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        body {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        #jobContainer {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
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

        #JobApplied {
            width: 90%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .applied-job {
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .applied-job img {
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

        .job-details p {
            margin-bottom: 10px;
        }

        .contact-link {
            margin-top: 10px;
            display: block;
            text-decoration: none;
            color: #007bff;
        }

        .no-applications {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }

        .currentPage a{
            background-color: #495057;
        }
        
        .applied-job {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        .top-left {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .name-title {
            flex-grow: 1;
        }

        .top-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-bottom: 10px;
        }

        .job-details {
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 8px;
        }

        .job-description {
            margin-bottom: 10px;
        }

        .status {
            margin-bottom: 10px;
        }

        .application-deadline {
            margin-bottom: 10px;
        }

        .actions {
            margin-top: 10px;
        }

        .contact-link {
            display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .contact-link:hover {
            background-color: #0056b3;
        }

        .info-box{
            display: flex;
            justify-content: space-between;
        }

    </style>
</head>
<body>
    
<section id="jobContainer">
    <aside id="asideNav">
        <div><a href="jobs.php">Back to Jobs</a></div>
        <div><a href="User_job_post.php">My Posts</a></div>
        <div><a href="PostJob.php">Post a Job</a></div>
        <div><a href="PeopleApplied.php">People Applied to My Jobs</a></div>
        <div class="currentPage"><a>Jobs Applied To</a></div>
    </aside>

    <article id="JobApplied">
        <?php
        if ($resultJobAppliedTo->num_rows > 0) {
            while ($rowJobAppliedTo = $resultJobAppliedTo->fetch_assoc()) {
                ?>
                <div class="applied-job">
                    <div class="info-box">
                        <div class="top-left">
                            <img src="<?php echo htmlspecialchars($rowJobAppliedTo['ProfilePictureURL']); ?>" alt="Profile" class="profile-image">
                            <div class="name-title">
                                <h5><?php echo htmlspecialchars($rowJobAppliedTo['Name']); ?></h5>
                                <p><?php echo htmlspecialchars($rowJobAppliedTo['Title']); ?></p>
                            </div>
                        </div>
                        
                        <div class="top-right">
                            <div class="posted-date"><?php echo $rowJobAppliedTo['PostedDate']; ?> / <?php echo $rowJobAppliedTo['ApplicationDeadline']; ?></div>
                            <div class="location"><?php echo htmlspecialchars($rowJobAppliedTo['Location']); ?></div>
                        </div>
                    </div>
                    <div class="job-details">
                        <div class="status">
                            <p><Strong>Status:</Strong> <?php echo htmlspecialchars($rowJobAppliedTo['STATUS']); ?></p>
                        </div>
                    </div>

                    <br>

                    <div class="job-details">
                        <div class="job-description">
                            <p><?php echo htmlspecialchars($rowJobAppliedTo['Description']); ?></p>
                        </div>
                    </div>

                    <div class="actions">
                        <a href="#" class="contact-link">Contact</a>
                    </div>
                </div>


                <?php
            }
        } else {
            echo "<p class='no-applications'>You have not applied to any jobs.</p>";
        }
        ?>
    </article>
</section>

</body>
</html>
