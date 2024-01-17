<?php
include "./config/db.php";

include "./includes/header.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: pages/login.php");
    exit();
}

// Retrieve user information from the database
$userID = $_SESSION['user_id'];
$sql = "SELECT u.*, p.*, pi.*
        FROM Users AS u
        INNER JOIN Posts AS p ON u.UserId = p.UserId
        LEFT JOIN PostInteractions AS pi ON p.PostID = pi.PostID AND u.UserId = pi.UserID";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $postUser = $result->fetch_assoc();
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

    <section>
        <div>
            <img src="../<?php echo $postUser['ProfilePictureURL']; ?>" alt='Profile'>
            <p><strong><?php echo $postUser['Name']; ?></strong></p>
        </div>

        <div>
            <div>
                <p><?php echo $postUser['Content']; ?></p>
            </div>

            <div>
                <img src="../<?php echo $postUser['ImageURL']; ?>" alt='Image post'>
            </div>
        </div>

        <div>
            <p><?php echo $postUser['ReactionStatus']; ?></p>
            <p>Comments</p>
        </div>

        <div>
            <div>
                <input type="text" name="" id="" placeholder="Add a comment">
            </div>

            <div>
                <?php echo $postUser['Comment']; ?>
            </div>
        </div>
    </section>



    <!-- Logout button -->
    <!--<form action="pages/logout.php" method="post">
        <input type="submit" value="Logout">
    </form>-->
</body>
</html>
