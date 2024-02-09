<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postID = $_POST['post_id'];
    $updates = [];

    // Check if content is provided
    if (!empty($_POST['content'])) {
        $content = $conn->real_escape_string($_POST['content']);
        $updates[] = "Content = '$content'";
    }

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = "uploads/posts/" . $fileName; // Default directory for file uploads
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to the server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $updates[] = "ImageURL = '$fileName'";
            }
        }
    }

    // Form the SQL based on whether content and/or image are updated
    if (!empty($updates)) {
        $updateSQL = "UPDATE Posts SET " . join(', ', $updates) . " WHERE PostID = $postID";
        if ($conn->query($updateSQL) === TRUE) {
            echo "Post updated successfully";
        } else {
            echo "Error updating post: " . $conn->error . "";
        }
    } else {
        echo "No updates made.";
    }

    $conn->close();
}

?>
