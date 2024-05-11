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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
    <style>
        body{
            height: 100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .all{
            display:flex;
            flex-direction:column; /* Change to column direction */
            max-width:80%;
            text-align:center;
            margin:auto;
            padding: 60px; /* Reduced padding for better mobile view */
            border-radius: 10px;
        }
        input{
            text-align:left;
            text-decoration: none;
            border: 2px solid lightgray;
        }
        img{
            margin-bottom:20px; /* Add margin at the bottom for spacing */
        }
    </style>
</head>
<body class="bg-primary">
    <div class="container"> <!-- Added Bootstrap container -->
        <div class="row justify-content-center"> <!-- Added Bootstrap row and justify-content-center -->
            <div class="col-12 col-lg-6"> <!-- Adjusted Bootstrap column classes for responsiveness -->
                <div class="all bg-light row d-flex justify-content-between">
                    <div class="text-center mb-3">
                        <img src="../img/logo.png" class="col-8 col-lg-6"> <!-- Adjusted column classes -->
                    </div>
                    <div class="main">
                        <h2 style="color:black;">Login to your account</h2>
                        <form method="post" action="">
                            <label>Email<br><input type="text" name="login_input" required></label><br>
                            <label>Password<br><input type="password" name="password" required></label><br>
                            <input class="logbutt" type="submit" name="login" value="Login">
                        </form>
                        <p class="signUp">New To FlexConnect? <button class="bt" onclick="window.location.href='signup.php'">Signup</button></p> 
                        <p class="fot">© FlexConnect 2024</p>
                        <p class="fot">Presented By Charbel Bou Faddoul, Christ Nakhoul, Elio Ghrayeb</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
