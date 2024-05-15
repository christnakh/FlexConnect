<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <a href="profile.php" class="btn btn-secondary mb-3">Back to Profile</a>
        <?php
        include "../config/db.php";

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $userID = $_SESSION['user_id'];

        $stmt = $conn->prepare("SELECT * FROM Users WHERE UserID = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            ?>
            <form action="edit_profile_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="UserID" value="<?php echo htmlspecialchars($user['UserID']); ?>">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" name="Name" value="<?php echo htmlspecialchars($user['Name']); ?>">
                </div>
                <div class="form-group">
                    <label>Profile Image:</label>
                    <button type="button" class="btn btn-primary" onclick="openImageEditModal()">Edit Image</button>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="Email" value="<?php echo htmlspecialchars($user['Email']); ?>">
                </div>
                <div class="form-group">
                    <label>Birth Date:</label>
                    <input type="date" class="form-control" name="birth_date" value="<?php echo htmlspecialchars($user['birth_date']); ?>">
                </div>
                <div class="form-group">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>">
                </div>
                <div class="form-group">
                    <label>Location:</label>
                    <input type="text" class="form-control" name="Location" value="<?php echo htmlspecialchars($user['Location']); ?>">
                </div>
                <div class="form-group">
                    <label>Industry:</label>
                    <input type="text" class="form-control" name="Industry" value="<?php echo htmlspecialchars($user['Industry']); ?>">
                </div>
                <div class="form-group">
                    <label>Summary:</label>
                    <textarea class="form-control" name="Summary"><?php echo htmlspecialchars($user['Summary']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>

            <?php
        } else {
            echo "<p>User not found.</p>";
        }
        $stmt->close();
        $conn->close();
        ?>
    </div>

    <div id="imageEditModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Profile Image</h2>
            <form action="edit_profile_process.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="UserID" value="<?php echo htmlspecialchars($user['UserID']); ?>">
                <div class="form-group">
                    <label for="newProfileImage">New Image:</label>
                    <input type="file" id="newProfileImage" name="ProfileImage" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>


    <script>
        var imageModal = document.getElementById("imageEditModal");
        var span = document.getElementsByClassName("close")[1];

        function openImageEditModal() {
            imageModal.style.display = "block";
        }

        span.onclick = function() {
            imageModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == imageModal) {
                imageModal.style.display = "none";
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
