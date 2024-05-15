<?php
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['UserID'])) {
    $fields = [];
    $params = [];

    if (!empty($_POST['Name'])) {
        $fields[] = 'Name = ?';
        $params[] = $_POST['Name'];
    }

    if (!empty($_POST['Email'])) {
        $fields[] = 'Email = ?';
        $params[] = $_POST['Email'];
    }

    if (!empty($_POST['birth_date'])) {
        $fields[] = 'birth_date = ?';
        $params[] = $_POST['birth_date'];
    }

    if (!empty($_POST['phone_number'])) {
        $fields[] = 'phone_number = ?';
        $params[] = $_POST['phone_number'];
    }

    if (!empty($_POST['Location'])) {
        $fields[] = 'Location = ?';
        $params[] = $_POST['Location'];
    }

    if (!empty($_POST['Industry'])) {
        $fields[] = 'Industry = ?';
        $params[] = $_POST['Industry'];
    }

    if (!empty($_POST['Summary'])) {
        $fields[] = 'Summary = ?';
        $params[] = $_POST['Summary'];
    }

    $profileImagePath = getCurrentImagePath($conn, $userID);
    if (isset($_FILES['ProfileImage']) && $_FILES['ProfileImage']['error'] == 0) {
        $profileImagePath = uploadImage($userID);
        $fields[] = 'ProfilePictureURL = ?';
        $params[] = $profileImagePath;
    }

    $params[] = $userID;
    $query = "UPDATE Users SET " . implode(', ', $fields) . " WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(str_repeat('s', count($fields)) . 'i', ...$params);
    $result = $stmt->execute();

    if ($result) {
        echo "<p>Profile updated successfully.</p>";
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

function uploadImage($userID) {
    $allowed = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
    $filename = $_FILES['ProfileImage']['name'];
    $filetype = $_FILES['ProfileImage']['type'];
    $filesize = $_FILES['ProfileImage']['size'];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

    $maxsize = 5 * 1024 * 1024;
    if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

    $uploadDir = "../uploads/users/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $newFilename = $userID . '_' . uniqid() . '.' . $ext;
    $profileImagePath = $uploadDir . $newFilename;
    
    if (!file_exists($profileImagePath)) {
        if (move_uploaded_file($_FILES['ProfileImage']['tmp_name'], $profileImagePath)) {
            return $profileImagePath;
        } else {
            die("Error: There was a problem uploading your file. Please try again.");
        }
    } else {
        die("Error: File already exists. Please rename the file or choose another.");
    }
}

function getCurrentImagePath($conn, $userID) {
    $query = $conn->prepare("SELECT ProfilePictureURL FROM Users WHERE UserID=?");
    $query->bind_param("i", $userID);
    $query->execute();
    $result = $query->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['ProfilePictureURL'];
    } else {
        return null;
    }
}
?>
