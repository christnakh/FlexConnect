<?php
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];
$postID = $_GET['post_id'] ?? 0;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$verifyQuery = "SELECT * FROM Posts WHERE PostID = $postID AND UserID = $userID";
$verifyResult = $conn->query($verifyQuery);


$deleteInteractionsSQL = "DELETE FROM PostInteractions WHERE PostID = $postID";
if ($conn->query($deleteInteractionsSQL) === TRUE) {
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
