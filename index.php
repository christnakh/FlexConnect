<?php
include "./config/db.php";


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: pages/login.php");
    exit();
}



// Retrieve user information from the database
$userID = $_SESSION['user_id'];
$sql = "SELECT * FROM Users WHERE UserID = $userID";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "Error fetching user information";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <p>Welcome, <?php echo $_SESSION['full_name']; ?>!</p>

    <!-- Display user information -->
    <p><strong>Name:</strong> <?php echo $user['Name']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
    <!-- Add more fields as needed -->

    <!-- Edit Profile button -->
    <a href="pages/profile.php">Edit Profile</a>

    <!-- Logout button -->
    <form action="pages/logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
