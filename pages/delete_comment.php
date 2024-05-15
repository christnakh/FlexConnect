<?php
include "../config/db.php";

if ($conn) {
    if (isset($_POST['comment_id'])) {
        $commentID = $_POST['comment_id'];
        $userID = $_SESSION['user_id']; 

        $checkQuery = $conn->prepare("SELECT * FROM Comments WHERE CommentID = ? AND UserID = ?");
        $checkQuery->bind_param("ii", $commentID, $userID);
        $checkQuery->execute();
        $result = $checkQuery->get_result();

        if ($result->num_rows > 0) {
            $deleteQuery = $conn->prepare("DELETE FROM Comments WHERE CommentID = ?");
            $deleteQuery->bind_param("i", $commentID);

            if ($deleteQuery->execute()) {
                echo "Comment deleted successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "You do not have permission to delete this comment.";
        }
    } else {
        echo "Invalid parameters.";
    }
} else {
    echo "Database connection error.";
}
?>
