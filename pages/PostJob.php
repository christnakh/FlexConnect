<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Job</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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
        #PostJob {
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .currentPage a {
            background-color: #495057;
        }
    </style>
    <script>
        function validateForm() {
            const postedDate = new Date().toISOString().split('T')[0];
            const applicationDeadline = document.getElementById('applicationDeadline').value;

            if (applicationDeadline <= postedDate) {
                alert('The application deadline must be later than today\'s date.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<section id="jobContainer">
    <aside id="asideNav">
        <br>
        <div><a href="jobs.php">Back to Jobs</a></div>
        <div><a href="User_job_post.php">My Posts</a></div>
        <div class='currentPage'><a>Post Job</a></div>
        <div><a href="PeopleApplied.php">People Applied to My Jobs</a></div>
        <div><a href="jobAppliedTo.php">Jobs I've Applied to</a></div>
    </aside>

    <article id="PostJob">
        <h2>Post a Job</h2>
        <form action="post_job.php" method="post" onsubmit="return validateForm()">
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" required>
            <br><br>
            <label for="description">Job Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            <br><br>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
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
