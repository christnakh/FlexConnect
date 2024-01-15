<?php
include "../config/db.php";

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['login'])) {
    $login_input = $_POST['login_input'];
    $password = $_POST['password'];

    // Simple SQL query without prepared statements (vulnerable to SQL injection)
    $sql = "SELECT * FROM Users WHERE Email='$login_input'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Simple password comparison (without hashing)
        if ($password === $row['Password']) {
            // Password is correct
            session_start();
            $_SESSION['user_id'] = $row['UserID'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['full_name'] = $row['Name'];

            echo "Login successful! Welcome, " . $row['Name'];

            header("Location: ../index.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    $result->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label>Login (Email): <input type="text" name="login_input" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <input type="submit" name="login" value="Login">
    </form>
    <button onclick="window.location.href='signup.php'">Signup</button>
</body>
</html>
