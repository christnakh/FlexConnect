<?php
session_start();
include "../config/db.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];
    $message_text = $_POST['message_text'];

    echo "Debug - Sender ID: $sender_id, Receiver ID: $receiver_id, Message Text: '$message_text'\n";

    if (empty($message_text)) {
        echo "Error: Message text is empty.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO Messages (SenderID, ReceiverID, MessageText, Timestamp) VALUES (?, ?, ?, NOW())");
    if ($stmt === false) {
        echo "Error: Prepare failed - " . $conn->error;
        exit;
    }

    if (!$stmt->bind_param("iis", $sender_id, $receiver_id, $message_text)) {
        echo "Error: Bind failed - " . $stmt->error;
        exit;
    }

    if (!$stmt->execute()) {
        echo "Error: Execute failed - " . $stmt->error;
        exit;
    } else {
        echo "Message successfully sent.";
    }
    $stmt->close();
}
$conn->close();
?>
