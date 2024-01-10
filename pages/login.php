<?php
include "../config/db.php";


if (isset($_POST['login'])) {
    $login_input = $_POST['login_input'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM User WHERE email='$login_input' OR phone_number='$login_input'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) {
            // Store user information in session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['full_name'] = $row['first_name'] . ' ' . $row['last_name'];

            echo "Login successful! Welcome, " . $row['username'];

            header("Location: ../index.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label>Login (Email/Phone): <input type="text" name="login_input" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <input type="submit" name="login" value="Login">
    </form>
    <button onclick="window.location.href='signup.php'">Signup</button>
</body>
</html>
