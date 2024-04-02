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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Document</title>

    <style>
        #jobContainer{
            display: flex;
            justify-content: flex-start;
            gap: 20%;
            padding: 20px;
        }

        #asideNav div:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>
    
    <section id="jobContainer">
        <aside id="asideNav">
            <div><a href="jobs.php">Back To job</a></div>
            <div>My post</div>
            <div><a href="PostJob.php">Post job</a></div>
            <div><a href="PeopleApplied.php">People applied to my job</a></div>
            <div><a href="jobAppliedTo.php">Job Applied to</a></div>
        </aside>

        <article id="MyJobs">
            <?php
                if ($resultJob -> num_rows > 0){
                    while ($row = $resultJob -> fetch_assoc()){
                        ?>
                            <div>
                                <div>
                                    <div>
                                        <img src="<?php echo $row['ProfilePictureURL']; ?>" alt="Profile" class="mr-3 rounded-circle">
                                        <div>
                                            <h5><?php echo $row['Name']; ?></h5>
                                            <p><?php echo $row['Title']; ?></p>
                                        </div>
                                    </div>

                                    <div>
                                        <p><?php echo $row['PostedDate']; ?></p>
                                        <p><?php echo $row['ApplicationDeadline']; ?></p>
                                        <p><?php echo $row['Location']; ?></p>
                                    </div>
                                </div>

                                <div>
                                    <p><?php echo $row['Description']; ?></p>
                                </div>

                                <div>
                                    <a href="delete_job_post.php?job_id=<?php echo $row['JobID']; ?>">Delete post</a>
                                    <a href="update_job_post.php?job_id=<?php echo $row['JobID']; ?>">Edit post</a>
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