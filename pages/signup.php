<?php
include "../config/db.php";

if (isset($_POST['signup'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO User (first_name, last_name, username, email, phone_number, role, password) VALUES (?, ?, ?, ?, ?, 'client', ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $username, $email, $phone_number, $password);

    if ($stmt->execute()) {
        echo "Signup successful!";
        header("location: login.php"); // Corrected the semicolon here
        exit(); // Ensure no further code execution after redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
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
    <form method="post" action="">
        <label>First Name: <input type="text" name="first_name" required></label><br>
        <label>Last Name: <input type="text" name="last_name" required></label><br>
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Phone Number: <input type="text" name="phone_number" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <input type="submit" name="signup" value="Signup">
    </form>

    <button onclick="window.location.href='login.php'">Login</button>
</body>
</html>
