<?php

include "../config/db.php";

$selectJobPeopleApplied = "
    SELECT j.*, a.*, u.Name, u.ProfilePictureURL, u.random_url, u.UserID
    FROM Jobs AS j
    LEFT JOIN ApplyJob AS a ON j.JobID = a.JobID
    LEFT JOIN Users AS u ON a.UserID = u.UserID
    WHERE a.EmployerID = $_SESSION[user_id]
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

    <style>
        body {
            font-family: Arial, sans-serif;
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

        .currentPage a{
            background-color: #495057;
        }

        .main {
            width: 90%;
            margin-left: 20px;
        }

        .job-post {
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f1f1f1;
        }

        .job-info h5,
        .job-info{
            margin: 0;
        }

        .posted-date{
            color:#666;
            margin-left:1000px
        }

        .job-info p {
            margin-bottom: 10px;
        }

        .applicant-info {
            margin-top: 10px; 
        }

        .applicant-info p {
            margin: 5px 0;
        }

        .applicant-info img {
            width: 50px; 
            height: 50px; 
            border-radius: 50%; 
            margin-right: 10px; 
        }
        ul{
            list-style-type:none;
        }
        h5{
            display:flex;
            flex-direction:row;
        }

        .BtnAcc{
            border: none;
            background-color: green;
            border-radius: 7px;
            padding: 10px;
            color: white;
        }

        .BtnDec{
            border: none;
            background-color: red;
            border-radius: 7px;
            padding: 10px;
            color: white;
        }
    </style>
</head>
<body>

    <section id="jobContainer">
        <aside id="asideNav">
            <div><a href="jobs.php">Back To job</a></div>
            <div><a href="User_job_post.php">My post</a></div>
            <div><a href="PostJob.php">Post job</a></div>
            <div class='currentPage'><a>People applied to my job</a></div>
            <div><a href="jobAppliedTo.php">Job Applied to</a></div>
        </aside>

        <article class="main">
        <?php
        if ($resultJobPeopleApplied->num_rows > 0) {
            while ($rowJobPeopleApplied = $resultJobPeopleApplied->fetch_assoc()) {
                echo '<div class="job-post">';
                echo '<div class="job-info">';
                echo '<h5>' . $rowJobPeopleApplied['Name'].'  <p class="posted-date">' .  $rowJobPeopleApplied['PostedDate'] .' / '.$rowJobPeopleApplied['ApplicationDeadline'] . '</p>'.'</h5>';
                echo '<h5 style="color:#666">' . $rowJobPeopleApplied['Title'] . '</h5>';
                echo '<h5 style="color:#666">' . $rowJobPeopleApplied['Location'] . '</h5>';                
                echo '<div class="applicant-info">';
                echo '<p><strong>Applicant Info:</strong></p>';
                echo '<ul>';
                echo '<img src="' . $rowJobPeopleApplied['ProfilePictureURL'] . '" alt="Applicant Profile">';
                echo '<li><strong>Name:</strong> ' . $rowJobPeopleApplied['Name'] . '</li>';
                echo '<li><strong>Status:</strong> ' . $rowJobPeopleApplied['STATUS'] . '</li>';
                echo '<li><strong>More Details:</strong> <a href="UserJobDetail.php?url=' . $rowJobPeopleApplied['random_url'] . '">Details</a></li>';
                echo '<li><button onclick="acceptApplication(\'' . $rowJobPeopleApplied['ApplyID'] . '\', \'' . $rowJobPeopleApplied['UserID'] . '\')" class="BtnAcc">Accept</button>  ';
                echo '<button onclick="declineApplication(\'' . $rowJobPeopleApplied['ApplyID'] . '\', \'' . $rowJobPeopleApplied['UserID'] . '\')" class="BtnDec">Decline</button></li>';   
                echo '</ul>';
               
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </article>
    </section>

    <script>
        function acceptApplication(ApplyID, UserID) {
            if (confirm("Are you sure you want to accept this application?")) {
                window.location.href = 'AcceptPeople.php?id=' + ApplyID + '&user=' + UserID;
            }
        }

        function declineApplication(ApplyID, UserID) {
            if (confirm("Are you sure you want to decline this application?")) {
                window.location.href = 'DeclinePeople.php?id=' + ApplyID + '&user=' + UserID;
            }
        }
    </script>
                 

</body>
</html>