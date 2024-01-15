<?php
include "../config/db.php";

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

function generateRandomURL($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomURL = '';
    for ($i = 0; $i < $length; $i++) {
        $randomURL .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomURL;
}

function isURLAvailable($conn, $url) {
    $url = mysqli_real_escape_string($conn, $url);
    $result = $conn->query("SELECT * FROM Users WHERE random_url = '$url'");
    return $result->num_rows == 0;
}

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $industry = mysqli_real_escape_string($conn, $_POST['industry']);
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
    $random_url = generateRandomURL();

    while (!isURLAvailable($conn, $random_url)) {
        $random_url = generateRandomURL();
    }

    $profilePictureURL = '';

    if ($_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/users/';
        $profilePictureURL = $uploadDir . generateRandomURL(5) . '_' . $_FILES['profilePicture']['name'];

        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $profilePictureURL)) {
            echo "File is valid, and was successfully uploaded.";
        } else {
            echo "Move_uploaded_file failed";
        }
    } else {
        echo "File upload failed with error code: " . $_FILES['profilePicture']['error'];
    }

    $query = "INSERT INTO Users (Name, Email, birth_date, phone_number, Password, Location, Industry, Summary, ProfilePictureURL, random_url) 
              VALUES ('$name', '$email', '$birth_date', '$phone_number', '$password', '$location', '$industry', '$summary', '$profilePictureURL', '$random_url')";

    if ($conn->query($query) === TRUE) {
        echo "Signup successful!";
        header("location: login.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <h2>Signup</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Birth Date: <input type="date" name="birth_date" required></label><br>
        <label>Phone Number: <input type="text" name="phone_number" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <label>Location: <input type="text" name="location" required></label><br>
        <label>Industry: <input type="text" name="industry" required></label><br>
        <label>Summary: <textarea name="summary" required></textarea></label><br>
        <label>Profile Picture: <input type="file" name="profilePicture" accept="image/*" required></label><br>

        <input type="submit" name="signup" value="Signup">
    </form>

    <button onclick="window.location.href='login.php'">Login</button>
</body>
</html>
