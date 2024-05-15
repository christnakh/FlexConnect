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

    
    if (!empty($_POST['content'])) {
        $content = $conn->real_escape_string($_POST['content']);
        $updates[] = "Content = '$content'";
    }

    
    if (!empty($_FILES['image']['name'])) {
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = "../uploads/posts/" . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowTypes)) {
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $updates[] = "ImageURL = '$fileName'";
            } else {
                echo "Error uploading file.";
                exit();
            }
        } else {
            echo "Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF.";
            exit();
        }
    }

    
    if (!empty($updates)) {
        $updateSQL = "UPDATE Posts SET " . implode(', ', $updates) . " WHERE PostID = $postID";
        if ($conn->query($updateSQL) === TRUE) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating post: " . $conn->error;
            exit();
        }
    } else {
        echo "No updates made.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
    exit();
}
?>
