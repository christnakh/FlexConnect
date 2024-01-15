<?php

include "../config/db.php";

session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['email']) ) {
    
    header("Location: pages/login.php");
    exit(); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <form action="pages/logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>