<?php
include "../config/db.php";

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

function generateRandomURL($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomURL = '';
    for ($i = 0, $max = strlen($characters) - 1; $i < $length; $i++) {
        $randomURL .= $characters[rand(0, $max)];
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
        $uploadDir = '../uploads/users/';
        $profilePictureURL = $uploadDir . generateRandomURL(5) . '_' . basename($_FILES['profilePicture']['name']);

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
        header("Location: login.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <title>Signup</title>
    <style>
        .container {
            margin-top: 300px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main">
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-6 col-xl-5">
                    <img src="../img/logo.png" class="img-fluid" alt="Sample image">
                </div>
                
                <div class="col-md-6 form-container">
                    <div class="row text-center">
                        <div class="col-6 col-md-10">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="divider d-flex align-items-center my-4">
                                    <p class="text-center fw-bold mx-3 mb-0">New here? Sign-Up</p>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Phone Number:</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">Birth Date:</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location:</label>
                                        <input type="text" class="form-control" id="location" name="location" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="industry" class="form-label">Industry:</label>
                                        <input type="text" class="form-control" id="industry" name="industry" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="summary" class="form-label">Summary:</label>
                                    <textarea class="form-control" id="summary" name="summary" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="profilePicture" class="form-label">Profile Picture:</label>
                                    <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="signup">Signup</button>
                            </form>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login.php" class="link-danger">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <div class="text-white mb-3 mb-md-0">
            Copyright © FlexConnect 2024. All rights reserved.
        </div>
    </div>
</body>
</html>
