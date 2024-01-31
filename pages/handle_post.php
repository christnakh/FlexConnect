<?php
include "../config/db.php";

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($conn) {
    if (isset($_POST['post_id'], $_POST['user_id'], $_POST['reaction'])) {
        $postID = $_POST['post_id'];
        $userID = $_POST['user_id'];
        $reaction = $_POST['reaction'];

        // Check if the user has already reacted
        $checkQuery = $conn->prepare("SELECT ReactionStatus FROM PostInteractions WHERE PostID = ? AND UserID = ?");
        $checkQuery->bind_param("ii", $postID, $userID);
        $checkQuery->execute();
        $result = $checkQuery->get_result();

        if ($result->num_rows > 0) {
            $existingReaction = $result->fetch_assoc()['ReactionStatus'];
            if ($existingReaction === $reaction) {
                // User clicked the same reaction again, remove it
                $deleteQuery = $conn->prepare("DELETE FROM PostInteractions WHERE PostID = ? AND UserID = ?");
                $deleteQuery->bind_param("ii", $postID, $userID);
                $deleteQuery->execute();
            } else {
                // Update the reaction
                $updateQuery = $conn->prepare("UPDATE PostInteractions SET ReactionStatus = ? WHERE PostID = ? AND UserID = ?");
                $updateQuery->bind_param("sii", $reaction, $postID, $userID);
                $updateQuery->execute();
            }
        } else {
            // Insert new reaction
            $insertQuery = $conn->prepare("INSERT INTO PostInteractions (PostID, UserID, ReactionStatus) VALUES (?, ?, ?)");
            $insertQuery->bind_param("iis", $postID, $userID, $reaction);
            $insertQuery->execute();
        }

        // Fetch updated counts
        $countsQuery = $conn->prepare("SELECT 
            (SELECT COUNT(*) FROM PostInteractions WHERE PostID = ? AND ReactionStatus = 'like') as likes,
            (SELECT COUNT(*) FROM PostInteractions WHERE PostID = ? AND ReactionStatus = 'love') as loves,
            (SELECT COUNT(*) FROM PostInteractions WHERE PostID = ? AND ReactionStatus = 'dislike') as dislikes
            FROM PostInteractions WHERE PostID = ? LIMIT 1");
        $countsQuery->bind_param("iiii", $postID, $postID, $postID, $postID);
        $countsQuery->execute();
        $result = $countsQuery->get_result();
        $counts = $result->fetch_assoc();

        echo json_encode($counts);
    } else {
        echo "Invalid request parameters.";
    }
} else {
    echo "Database connection error.";
}
?>
