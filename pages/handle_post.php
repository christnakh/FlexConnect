<?php
include "../config/db.php";  // Ensure this path is correct

header('Content-Type: application/json'); // Send proper header for JSON content

if ($conn) {
    if (isset($_POST['post_id'], $_POST['user_id'], $_POST['reaction'])) {
        $postID = $_POST['post_id'];
        $userID = $_POST['user_id'];
        $reaction = $_POST['reaction'];

        // Check if the user has already reacted
        $checkQuery = $conn->prepare("SELECT ReactionStatus FROM PostInteractions WHERE PostID = ? AND UserID = ?");
        $checkQuery->bind_param("ii", $postID, $userID);
        if (!$checkQuery->execute()) {
            echo json_encode(['error' => 'Error executing check query: ' . $conn->error]);
            exit();
        }
        $result = $checkQuery->get_result();

        if ($result->num_rows > 0) {
            $existingReaction = $result->fetch_assoc()['ReactionStatus'];
            if ($existingReaction === $reaction) {
                // User clicked the same reaction again, remove it
                $deleteQuery = $conn->prepare("DELETE FROM PostInteractions WHERE PostID = ? AND UserID = ?");
                $deleteQuery->bind_param("ii", $postID, $userID);
                if (!$deleteQuery->execute()) {
                    echo json_encode(['error' => 'Error executing delete query: ' . $conn->error]);
                    exit();
                }
            } else {
                // Update the reaction
                $updateQuery = $conn->prepare("UPDATE PostInteractions SET ReactionStatus = ? WHERE PostID = ? AND UserID = ?");
                $updateQuery->bind_param("sii", $reaction, $postID, $userID);
                if (!$updateQuery->execute()) {
                    echo json_encode(['error' => 'Error executing update query: ' . $conn->error]);
                    exit();
                }
            }
        } else {
            // Insert new reaction
            $insertQuery = $conn->prepare("INSERT INTO PostInteractions (PostID, UserID, ReactionStatus) VALUES (?, ?, ?)");
            $insertQuery->bind_param("iis", $postID, $userID, $reaction);
            if (!$insertQuery->execute()) {
                echo json_encode(['error' => 'Error executing insert query: ' . $conn->error]);
                exit();
            }
        }

        // Fetch updated counts
        $countsQuery = $conn->prepare("SELECT 
            (SELECT COUNT(*) FROM PostInteractions WHERE PostID = ? AND ReactionStatus = 'like') as likes,
            (SELECT COUNT(*) FROM PostInteractions WHERE PostID = ? AND ReactionStatus = 'love') as loves,
            (SELECT COUNT(*) FROM PostInteractions WHERE PostID = ? AND ReactionStatus = 'dislike') as dislikes
            FROM Dual");  // Use 'DUAL' for dummy table in single-row queries
        $countsQuery->bind_param("iii", $postID, $postID, $postID);
        if (!$countsQuery->execute()) {
            echo json_encode(['error' => 'Error executing counts query: ' . $conn->error]);
            exit();
        }
        $result = $countsQuery->get_result();
        $counts = $result->fetch_assoc();

        echo json_encode($counts);
    } else {
        echo json_encode(['error' => 'Invalid request parameters']);
    }
} else {
    echo json_encode(['error' => 'Database connection error']);
}
?>
