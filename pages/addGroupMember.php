<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group_id = $_POST['group_id'];
    $user_id = $_POST['user_id'];

    $stmt = $conn->prepare("INSERT INTO UserGroups (GroupID, UserID, Role, JoinedDate) VALUES (?, ?, 'Member', CURDATE())");
    $stmt->bind_param("ii", $group_id, $user_id);
    $stmt->execute();

    echo $stmt->affected_rows > 0 ? "Member added successfully." : "Error adding member.";
    $stmt->close();
}
$conn->close();
?>