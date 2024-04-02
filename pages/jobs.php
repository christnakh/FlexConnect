<?php
include "../includes/header.php";

// Get current date
$currentDate = date("Y-m-d");

$selectJob = "SELECT u.*, j.* FROM Users as u INNER JOIN Jobs as j on u.UserID = j.EmployerID WHERE EmployerID <> $_SESSION[user_id] AND j.PostedDate <= '$currentDate' AND j.ApplicationDeadline >= '$currentDate'";
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
            <div>Jobs</div>
            <div><a href="User_job_post.php">My job post</a></div>
        </aside>

        <article id="Jobs">
            <?php
                if ($resultJob->num_rows > 0) {
                    while ($row = $resultJob->fetch_assoc()) {
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
                                <a href="#">Contact</a>
                                <a href="apply_job.php?jobID=<?php echo $row['JobID']; ?>&employerID=<?php echo $row['EmployerID']; ?>">Apply</a>
                            </div>
                        </div>
                        <br><br><br>
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
