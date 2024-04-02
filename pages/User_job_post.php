<?php

include "../config/db.php";

$selectJob = "SELECT u.*, j.* FROM Users as u INNER JOIN Jobs as j on u.UserID = j.EmployerID WHERE j.EmployerID = $_SESSION[user_id]";
$resultJob = $conn -> query($selectJob);

$selectPeopleApplied = "SELECT u.*, a.* FROM Users as u INNER JOIN ApplyJob as a on u.UserID = a.UserID WHERE a.EmployerID = $_SESSION[user_id]";
$resultAppliedJob = $conn -> query($selectPeopleApplied);

$selectJobAppliedTo = "SELECT u.*, j.*, a.* FROM Users as u INNER JOIN Jobs as j on u.UserID = j.EmployerID INNER JOIN ApplyJob as a on j.JobID = a.JobID WHERE a.UserID = $_SESSION[user_id]";
$resultJobAppliedTo = $conn -> query($selectJobAppliedTo);

// $selectJobPeopleApplied = "
//     SELECT j.*, a.*, u.Name, u.ProfilePictureURL, u.random_url
//     FROM Jobs AS j
//     LEFT JOIN ApplyJob AS a ON j.JobID = a.JobID
//     LEFT JOIN Users AS u ON a.UserID = u.UserID
//     WHERE j.EmployerID = $_SESSION[user_id]
//     ORDER BY j.JobID, a.ApplyID
// ";
// $resultJobPeopleApplied = $conn->query($selectJobPeopleApplied);

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
                                    <a href="update_job_post.php?job_id=<?php echo $row['JobID']; ?>">Edit post</a>
                                </div>
                            </div>
                            <br><br><br>
                        <?php
                    }
                }
            ?>
        </article>

        <article id="PostJob">
            <!--<form action="post_job.php" method="post">
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
            </form>-->
        </article>

        <article id="PeopleApplied">
            <?php
//                if ($resultJobPeopleApplied->num_rows > 0) {
//                    $currentJobID = null;
//
//                    while ($rowJobPeopleApplied = $resultJobPeopleApplied->fetch_assoc()) {
//                        if ($rowJobPeopleApplied['JobID'] != $currentJobID) {
//                            // Display job information
//                            if ($currentJobID !== null) {
//                                echo '</ul>';
//                                echo '</div>';
//                                echo '<br><br><br>';
//                            }
//
//                            echo '<div>';
//                            echo '<div>';
//                            echo '<div>';
//                            echo '<img src="' . $rowJobPeopleApplied['ProfilePictureURL'] . '" alt="Profile" class="mr-3 rounded-circle">';
//                            echo '<div>';
//                            echo '<h5>' . $rowJobPeopleApplied['Name'] . '</h5>';
//                            echo '<p>' . $rowJobPeopleApplied['Title'] . '</p>';
//                            echo '</div>';
//                            echo '</div>';
//
//                            echo '<div>';
//                            echo '<p>' . $rowJobPeopleApplied['PostedDate'] . '</p>';
//                            echo '<p>' . $rowJobPeopleApplied['Location'] . '</p>';
//                            echo '</div>';
//                            echo '</div>';
//
//                            echo '<div>';
//                            echo '<p>' . $rowJobPeopleApplied['Description'] . '</p>';
//                            echo '</div>';
//
//                            echo '<div>';
//                            echo '<h6>People who applied to this job:</h6>';
//                            echo '<ul>';
//                        }
//
//                        // Display applicant information
//                        echo '<li style="list-style-type: none;">';
//                        echo '<img src="' . $rowJobPeopleApplied['ProfilePictureURL'] . '" alt="Applicant Profile" class="mr-3 rounded-circle">';
//                        echo '<span>' . $rowJobPeopleApplied['Name'] . '</span>';
//                        echo '<span><a href="UserJobDetail.php?url=' . $rowJobPeopleApplied['random_url'] . '">Details</a></span>';
//                        echo '</li> <br><br><br>';
//
//                        $currentJobID = $rowJobPeopleApplied['JobID'];
//                    }
//
//                    echo '</ul>';
//                    echo '</div>';
//                    echo '<br><br><br>';
//                }
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