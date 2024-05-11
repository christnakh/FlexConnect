<?php
include "../config/db.php";

$search_query = $_POST['search_query'];
$stmt = $conn->prepare("SELECT UserID, Name FROM Users WHERE Name LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("s", $search_query);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
$stmt->close();
$conn->close();
?>
