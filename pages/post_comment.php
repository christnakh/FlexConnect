<?php
include "../config/db.php";

header('Content-Type: application/json');

if ($conn) {
    if (isset($_POST['post_id'], $_POST['user_id'], $_POST['comment_text']) && !empty($_POST['comment_text'])) {
        $postID = $_POST['post_id'];
        $userID = $_POST['user_id'];
        $commentText = $_POST['comment_text'];

        
        $userNameQuery = $conn->prepare("SELECT Name FROM Users WHERE UserID = ?");
        $userNameQuery->bind_param("i", $userID);
        $userNameQuery->execute();
        $result = $userNameQuery->get_result();
        $user = $result->fetch_assoc();
        $userName = $user['Name'];

        $insertQuery = $conn->prepare("INSERT INTO Comments (PostID, UserID, CommentText, CommentDate) VALUES (?, ?, ?, NOW())");
        $insertQuery->bind_param("iis", $postID, $userID, $commentText);

        if ($insertQuery->execute()) {
            $newCommentID = $conn->insert_id;
            $response = [
                'status' => 'success',
                'message' => 'Comment added successfully.',
                'data' => [
                    'commentID' => $newCommentID,
                    'userName' => $userName, 
                    'commentText' => $commentText
                ]
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Error: ' . $conn->error
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Comment text is required.'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Database connection error.'
    ];
}

echo json_encode($response);
?>
