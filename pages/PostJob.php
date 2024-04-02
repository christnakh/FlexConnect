<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Post job</title>

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
            <div><a href="User_job_post.php">My post</a></div>
            <div>Post job</div>
            <div><a href="PeopleApplied.php">People applied to my job</a></div>
            <div><a href="jobAppliedTo.php">Job Applied to</a></div>
        </aside>

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
    </section>

</body>
</html>