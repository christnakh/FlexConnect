<?php

include "../config/db.php";

$selectJob = "SELECT u.*, j.* FROM Users as u INNER JOIN Jobs as j on u.UserID = j.EmployerID WHERE j.EmployerID = $_SESSION[user_id]";
$resultJob = $conn -> query($selectJob);

$selectPeopleApplied = "SELECT u.*, a.* FROM Users as u INNER JOIN ApplyJob as a on u.UserID = a.UserID WHERE a.EmployerID = $_SESSION[user_id]";
$resultAppliedJob = $conn -> query($selectPeopleApplied);

$selectJobAppliedTo = "SELECT u.*, j.*, a.* FROM Users as u INNER JOIN Jobs as j on u.UserID = j.EmployerID INNER JOIN ApplyJob as a on j.JobID = a.JobID WHERE a.UserID = $_SESSION[user_id]";
$resultJobAppliedTo = $conn -> query($selectJobAppliedTo);

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
        
        #PeopleApplied, #PostJob, #JobApplied{
            display: none;
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
            <div onclick="DisplayMypost()">My post</div>
            <div onclick="DisplayPostJob()">Post job</div>
            <div onclick="DisplayPeopleApplied()">People applied to my job</div>
            <div onclick="DisplayJobAppliedTO()">Job Applied to</div>
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
                                        <p><?php echo $row['Location']; ?></p>
                                    </div>
                                </div>

                                <div>
                                    <p><?php echo $row['Description']; ?></p>
                                </div>

                                <div>
                                    <a href="delete_job_post.php?job_id=<?php echo $row['JobID']; ?>">Delete post</a>
                                </div>
                            </div>
                            <br><br><br>
                        <?php
                    }
                }
            ?>
        </article>

        <article id="PostJob">
            <form action="post_job.php" method="post">
                <label for="title">Job Title:</label>
                <input type="text" id="title" name="title" required>
                <br><br>
                <label for="description">Job Description:</label>
                <textarea id="description" name="description" required></textarea>
                <br><br>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
                <br><br>
                <label for="postedDate">Posted Date: <?php echo date('Y-m-d'); ?></label>
                <br><br>
                <label for="applicationDeadline">Application Deadline:</label>
                <input type="date" id="applicationDeadline" name="applicationDeadline" required>
                <br><br>
                <button type="submit">Post Job</button>
            </form>
        </article>

        <article id="PeopleApplied">
            <?php
                if ($resultAppliedJob -> num_rows > 0){
                    while ($rowAppliedJob = $resultAppliedJob -> fetch_assoc()){
                        ?>
                            <div>
                                <div>
                                    <div>
                                        <img src="<?php echo $rowAppliedJob['ProfilePictureURL']; ?>" alt="Profile" class="mr-3 rounded-circle">
                                        <div>
                                            <h5><?php echo $rowAppliedJob['Name']; ?></h5>
                                            <p><?php echo $rowAppliedJob['ConnectionStatus']; ?></p>
                                        </div>
                                    </div>

                                    <div>
                                        <p><?php echo $rowAppliedJob['ConnectedSince']; ?></p>
                                    </div>

                                    <div>
                                        <a href="#">Contact <?php echo $rowAppliedJob['Name']; ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>
        </article>

        <article id="JobApplied">
            <?php
                if ($resultJobAppliedTo -> num_rows > 0){
                    while ($rowJobAppliedTo = $resultJobAppliedTo -> fetch_assoc()){
                        ?>
                            <div>
                                <div>
                                    <div>
                                        <img src="<?php echo $rowJobAppliedTo['ProfilePictureURL']; ?>" alt="Profile" class="mr-3 rounded-circle">
                                        <div>
                                            <h5><?php echo $rowJobAppliedTo['Name']; ?></h5>
                                            <p><?php echo $rowJobAppliedTo['Title']; ?></p>
                                        </div>
                                    </div>

                                    <div>
                                        <p><?php echo $rowJobAppliedTo['PostedDate']; ?></p>
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
            

    <script>
        function DisplayMypost(){
            document.getElementById("MyJobs").style.display='block';
            document.getElementById("PeopleApplied").style.display='none';
            document.getElementById("PostJob").style.display='none';
            document.getElementById("JobApplied").style.display='none';
        }

        function DisplayPostJob(){
            document.getElementById("MyJobs").style.display='none';
            document.getElementById("PeopleApplied").style.display='none';
            document.getElementById("PostJob").style.display='block';
            document.getElementById("JobApplied").style.display='none';
        }

        function DisplayPeopleApplied(){
            document.getElementById("MyJobs").style.display='none';
            document.getElementById("PeopleApplied").style.display='block';
            document.getElementById("PostJob").style.display='none';
            document.getElementById("JobApplied").style.display='none';
        }

        function DisplayJobAppliedTO(){
            document.getElementById("MyJobs").style.display='none';
            document.getElementById("PeopleApplied").style.display='none';
            document.getElementById("PostJob").style.display='none';
            document.getElementById("JobApplied").style.display='block';
        }
    </script>
</body>
</html>