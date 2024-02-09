<?php
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];
$postID = $_GET['post_id'] ?? 0; // Assuming the post ID is sent via GET request

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify that the post belongs to the user
$verifyQuery = "SELECT * FROM Posts WHERE PostID = $postID AND UserID = $userID";
$verifyResult = $conn->query($verifyQuery);

// First, delete the related interactions
$deleteInteractionsSQL = "DELETE FROM PostInteractions WHERE PostID = $postID";
if ($conn->query($deleteInteractionsSQL) === TRUE) {
    // Now, delete the post
    $deleteSQL = "DELETE FROM Posts WHERE PostID = $postID";
    if ($conn->query($deleteSQL) === TRUE) {
        echo "<script>window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error deleting post: " . $conn->error . "'); window.location.href='profile.php';</script>";
    }
} else {
    echo "<script>alert('Error deleting post interactions: " . $conn->error . "'); window.location.href='profile.php';</script>";
}


$conn->close();
?>
