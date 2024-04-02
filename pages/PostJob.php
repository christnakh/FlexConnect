<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Post job</title>

</head>
<body>

    <section>
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