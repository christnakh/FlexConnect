<?php

include "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['jobID']) && isset($_GET['employerID'])) {
    $userLogin = $_SESSION['user_id'];
    $jobID = $_GET['jobID'];
    $employerID = $_GET['employerID'];

    $selectUser = "SELECT Name FROM Users WHERE UserID = $userLogin";
    $selectResult = $conn->query($selectUser);
    $ConnectionSince = date('Y-m-d');

    if ($selectResult->num_rows > 0) {
        $userName = $selectResult->fetch_assoc();
    } else {
        $userName = array();
    }

    $testInsert = "SELECT * FROM ApplyJob WHERE UserID = $userLogin AND jobID = $jobID";
    $Testresult = $conn->query($testInsert);

    if ($Testresult) {
        if ($Testresult->num_rows > 0) {
            $row = $Testresult->fetch_assoc();
            $status = $row['STATUS'];

            if ($status == 'Pending') {
                echo "<script>alert('You have already applied to this job. Please wait for a response.');</script>";
                echo "<script>window.location.href = 'Jobs.php';</script>";
                exit();
            } elseif ($status == 'Accepted') {
                echo "<script>alert('You have been accepted for this job.');</script>";
                echo "<script>window.location.href = 'Jobs.php';</script>";
                exit();
            } elseif ($status == 'Declined') {
                echo "<script>alert('You have been declined for this job.');</script>";
                echo "<script>window.location.href = 'Jobs.php';</script>";
                exit();
            }
        } else {
            $Description = $userName['Name'] . " wants to apply for the job you posted. Click <a href='ViewJob.php?jobID=$jobID'>here</a> to view the job and accept the application.";

            $insertApply = "INSERT INTO ApplyJob (UserID, jobID, EmployerID, connectionStatus, ConnectedSince) VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insertApply);

            $stmt->bind_param("iiiss", $userLogin, $jobID, $employerID, $Description, $ConnectionSince);

            $stmt->execute();

            $stmt->close();

            echo "<script>alert('Application submitted successfully!');</script>";
            echo "<script>window.location.href = 'Jobs.php';</script>";
            exit();
        }
    }
}

?>
