<?php
session_start();
include "../config/db.php";

$receiver_id = $_SESSION['user_id']; 
$sender_id = $_POST['receiver_id']; 

$stmt = $conn->prepare("SELECT m.MessageText, u.Name as SenderName FROM Messages m JOIN Users u ON m.SenderID = u.UserID WHERE (m.ReceiverID = ? AND m.SenderID = ?) OR (m.ReceiverID = ? AND m.SenderID = ?) ORDER BY m.Timestamp ASC");
$stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);

$stmt->close();
$conn->close();
?>
