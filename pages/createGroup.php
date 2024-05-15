<?php
session_start();
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['UserID'])) {
    $creator_id = $_SESSION['user_id'];
    $group_name = $_POST['group_name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO Groups (GroupName, Description) VALUES (?, ?)");
    $stmt->bind_param("ss", $group_name, $description);
    $stmt->execute();

    $group_id = $stmt->insert_id;

    if ($stmt->affected_rows > 0) {
        $stmt = $conn->prepare("INSERT INTO UserGroups (GroupID, UserID, Role, JoinedDate) VALUES (?, ?, 'Creator', CURDATE())");
        $stmt->bind_param("ii", $group_id, $creator_id);
        $stmt->execute();
    }

    echo $stmt->affected_rows > 0 ? "Group created successfully." : "Error creating group.";
    $stmt->close();
}
$conn->close();
?>