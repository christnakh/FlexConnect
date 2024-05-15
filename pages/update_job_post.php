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
    <title>Update Job Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 50px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background: #f8f9fa;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
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
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h2>Update Job Post</h2>

    <form action="update_job_post.php" method="post">
        <input type="hidden" name="jobID" value="<?php echo $rowJobToUpdate['JobID']; ?>">

        <div class="form-group">
            <label for="title">Job Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $rowJobToUpdate['Title']; ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Job Description:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required><?php echo $rowJobToUpdate['Description']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $rowJobToUpdate['Location']; ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="applicationDeadline">Application Deadline:</label>
            <input type="date" id="applicationDeadline" name="applicationDeadline" value="<?php echo $rowJobToUpdate['ApplicationDeadline']; ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Job Post</button> <br><br>
        <a href="javascript:history.back()" class="back-button">Back</a>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
