<?php
include "../config/db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $employerID = $_SESSION['user_id'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $postedDate = date('Y-m-d');
    $applicationDeadline = $_POST['applicationDeadline'];

    if ($applicationDeadline <= $postedDate) {
        echo "<script>
                alert('The application deadline must be later than today\'s date.');
                window.location.href = 'post_job_form.php'; // Redirect to the form page
              </script>";
    } else {
        $insertQuery = "INSERT INTO Jobs (EmployerID, Title, Description, Location, PostedDate, ApplicationDeadline)
                        VALUES ('$employerID', '$title', '$description', '$location', '$postedDate', '$applicationDeadline')";

        $conn->query($insertQuery);

        header("Location: User_job_post.php");
        exit();
    }
}
?>
