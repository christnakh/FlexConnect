<?php

include "../config/db.php";

$userID = $_SESSION["user_id"];
$applyID = $_GET['id'];
$userApplied = $_GET['user'];

$StatusAccept = "UPDATE ApplyJob SET `STATUS` = 'Declined' WHERE ApplyID = $applyID";
$conn -> query($StatusAccept);

$jobQuery = "SELECT Jobs.Title FROM Jobs INNER JOIN ApplyJob ON Jobs.JobID = ApplyJob.JobID WHERE ApplyJob.ApplyID = $applyID";
$jobResult = $conn->query($jobQuery);
$jobTitle = "";

if ($jobResult && $jobResult->num_rows > 0) {
    $jobRow = $jobResult->fetch_assoc();
    $jobTitle = $jobRow['Title'];
} else {
    echo "Error fetching job title: " . $conn->error;
}

$notificationMessage = mysqli_real_escape_string($conn, "Your application for the job '$jobTitle' has been declined");

$sendNotification = "INSERT INTO `Notification` (SenderUserID, ReceiverUserID, NotificationMessage, NotificationType) 
                     VALUES ('$userID', '$userApplied', '$notificationMessage', 'Declined')";

if ($conn->query($sendNotification) === TRUE) {
    echo "Notification sent successfully";
} else {
    echo "Error sending notification: " . $conn->error;
}

header("Location: PeopleApplied.php");
exit();

?>