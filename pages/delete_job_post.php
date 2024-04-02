<?php
include "../config/db.php";

if (isset($_GET['job_id']) && is_numeric($_GET['job_id'])) {
    $job_id = $_GET['job_id'];


        $deleteJob = "DELETE FROM Jobs WHERE JobID = $job_id";
        $resultJob = $conn->query($deleteJob);

        if ($resultJob) {
            echo "<script>alert('Post Deleted Successfully!');</script>";
            echo "<script>window.location.href = 'User_job_post.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error deleting job post');</script>";
            echo "<script>window.location.href = 'User_job_post.php';</script>";
            exit();
        }

} else {
    echo "Invalid job ID";
}
?>
