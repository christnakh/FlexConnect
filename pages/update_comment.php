<?php
include "../config/db.php"; // Adjust the path as needed

session_start();

if (!isset($_SESSION['user_id'])) {
    // Handle the error or redirect
    exit('User not logged in');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentID = $_POST['comment_id'];
    $commentText = $_POST['comment_text'];
    $userID = $_SESSION['user_id'];

    // Update query
    $query = "UPDATE Comments SET CommentText = ? WHERE CommentID = ? AND UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $commentText, $commentID, $userID);

    if ($stmt->execute()) {
        echo "Comment updated successfully";
    } else {
        echo "Error updating comment: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
