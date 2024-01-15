<?php
include "../config/db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include your database connection file

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

// Process form submission to update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    // Add more fields as needed

    // Perform the update in the database
    $updateSql = "UPDATE Users SET Name='$newName', Email='$newEmail' WHERE UserID=$userID";

    if ($conn->query($updateSql) === TRUE) {
        echo "Profile updated successfully!";
        // You may redirect the user back to the profile page or perform any other action
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <p>Welcome, <?php echo $_SESSION['full_name']; ?>!</p>

    <!-- Display user information -->
    <p><strong>Name:</strong> <?php echo $user['Name']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
    <!-- Add more fields as needed -->

    <!-- Form to edit profile information -->
    <form action="" method="post">
        <label>New Name: <input type="text" name="name" value="<?php echo $user['Name']; ?>" required></label><br>
        <label>New Email: <input type="email" name="email" value="<?php echo $user['Email']; ?>" required></label><br>
        <!-- Add more fields as needed -->

        <input type="submit" name="submit" value="Save Changes">
    </form>

    <!-- Logout button -->
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
