<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobID = $_POST["jobID"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $applicationDeadline = $_POST["applicationDeadline"];

    $updateJob = "UPDATE Jobs SET Title='$title', Description='$description', Location='$location', ApplicationDeadline='$applicationDeadline' WHERE JobID=$jobID";

    if ($conn->query($updateJob) === TRUE) {
        echo "<script>alert('Post Updated Successfully!');</script>";
        echo "<script>window.location.href = 'User_job_post.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating job post');</script>";
        echo "<script>window.location.href = 'User_job_post.php';</script>";
        exit();
    }
}

$jobID = $_GET["job_id"];
$selectJobToUpdate = "SELECT * FROM Jobs WHERE JobID = $jobID";
$resultJobToUpdate = $conn->query($selectJobToUpdate);
if ($resultJobToUpdate->num_rows > 0) {
    $rowJobToUpdate = $resultJobToUpdate->fetch_assoc();
} else {
    echo "Job not found";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Update Job Post</title>
</head>
<body>

    <h2>Update Job Post</h2>

    <form action="update_job_post.php" method="post">
        <input type="hidden" name="jobID" value="<?php echo $rowJobToUpdate['JobID']; ?>">

        <label for="title">Job Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $rowJobToUpdate['Title']; ?>" required>
        <br><br>

        <label for="description">Job Description:</label>
        <textarea id="description" name="description" required><?php echo $rowJobToUpdate['Description']; ?></textarea>
        <br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $rowJobToUpdate['Location']; ?>" required>
        <br><br>

        <label for="applicationDeadline">Application Deadline:</label>
        <input type="date" id="applicationDeadline" name="applicationDeadline" value="<?php echo $rowJobToUpdate['ApplicationDeadline']; ?>" required>
        <br><br>

        <button type="submit">Update Job Post</button>
    </form>

</body>
</html>