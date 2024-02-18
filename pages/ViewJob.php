<?php

include "../config/db.php";

if (isset($_GET['jobID'])) {
    $jobID = $_GET['jobID'];

    $selectJob = "SELECT u.*, j.* FROM Users as u INNER JOIN Jobs as j on u.UserID = j.EmployerID WHERE JobID = $jobID";
    $resultJob = $conn -> query($selectJob);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <section>
        <div><a href="User_job_post.php">Back To My post</a></div>

        <section id="jobContainer">
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