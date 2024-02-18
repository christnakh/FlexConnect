<?php
include "../config/db.php";

if (isset($_GET['job_id']) && is_numeric($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // Delete related rows from ApplyJob table first
    $deleteApplyJob = "DELETE FROM ApplyJob WHERE JobID = $job_id";
    $resultApplyJob = $conn->query($deleteApplyJob);

    if ($resultApplyJob) {
        $deleteJob = "DELETE FROM Jobs WHERE JobID = $job_id";
        $resultJob = $conn->query($deleteJob);

        if ($resultJob) {
            echo "<script>alert('Post Deleted successfully!');</script>";
            echo "<script>window.location.href = 'User_job_post.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error deleting job post');</script>";
            echo "<script>window.location.href = 'User_job_post.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Error deleting related ApplyJob rows');</script>";
        echo "<script>window.location.href = 'User_job_post.php';</script>";
        exit();
    }
} else {
    echo "Invalid job ID";
}
?>
