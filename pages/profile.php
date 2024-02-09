<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select user information
$userSQL = "SELECT * FROM Users WHERE UserID = $userID";
$userResult = $conn->query($userSQL);

if ($userResult->num_rows == 1) {
    $user = $userResult->fetch_assoc();
} else {
    echo "Error fetching user information";
    exit();
}

// Select skills information
$skillsSQL = "SELECT * FROM Skills WHERE UserID = $userID";
$skillsResult = $conn->query($skillsSQL);

if ($skillsResult->num_rows > 0) {
    $skills = $skillsResult->fetch_assoc();
    // Fetch other data as needed
} else {
    $skills = array(); // Empty array if no skills found
}

// Select posts information
$postsSQL = "SELECT u.*, p.* FROM Users u INNER JOIN Posts p ON u.UserID = p.UserID WHERE u.UserID = $userID";
$postsResult = $conn->query($postsSQL);

if ($postsResult->num_rows > 0) {
    $posts = $postsResult->fetch_assoc();
    // Fetch other data as needed
} else {
    $posts = array(); // Empty array if no posts found
}


// Select experience information
$experienceSQL = "SELECT * FROM Experience WHERE UserID = $userID";
$experienceResult = $conn->query($experienceSQL);

if ($experienceResult->num_rows > 0) {
    $experience = $experienceResult->fetch_assoc();
    // Fetch other data as needed
} else {
    $experience = array(); // Empty array if no experience found
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <section class="container">
        <!-- Display user information -->
        <div class="jumbotron mt-5">
            <h1 class="display-4">User Profile</h1>
            <hr class="my-4">
            <p class="lead">Name: <?php echo $user['Name']; ?></p>
            <p class="lead">Email: <?php echo $user['Email']; ?></p>
            <!-- Display other information from $skills, $posts, $experience, $endorsements arrays as needed -->
            <p class="lead"><a href="create_post.php" class="btn btn-primary">Create Post</a></p>
            <p class="lead"><a href="edit_experience.php" class="btn btn-primary">Edit Experience</a></p>
            <p class="lead"><a href="edit_education.php" class="btn btn-primary">Edit Education</a></p>
            <p class="lead"><a href="edit_skills.php" class="btn btn-primary">Edit Skills</a></p>
            <form action="logout.php" method="post">
                <input type="submit" class="btn btn-danger" value="Logout">
            </form>
            <a href="/" class="btn btn-secondary">Back home</a>
        </div>

        <!-- Add CSS for the modal -->

        <h1>User Posts</h1>
        <!-- Posts and other content -->

        <!-- The Modal -->
        <?php if ($postsResult->num_rows > 0): ?>
            <?php while($post = $postsResult->fetch_assoc()): ?>
                <div class="card my-3">
                    <div class="card-body">
                        <img src="<?php echo $post['ProfilePictureURL']; ?>" alt="Profile Picture" class="rounded-circle">
                        <h5 class="card-title"><?php echo $post['Name']; ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($post['Content']); ?></p>
                        <img src="<?php echo '../uploads/posts/'.($post['ImageURL']); ?>" alt="Post Image" class="img-fluid">
                        <p class="card-text">Likes: <?php echo $post['Likes']; ?></p>
                        <p class="card-text">Dislikes: <?php echo $post['Dislikes']; ?></p>
                        <p class="card-text">Loves: <?php echo $post['Loves']; ?></p>
                        <!-- Edit and Delete buttons (only show if the post belongs to the logged-in user) -->
                        <?php if ($post['UserID'] == $userID): ?>
                            <a href="javascript:void(0)" onclick="openEditModal('<?php echo $post['PostID']; ?>', '<?php echo htmlspecialchars($post['Content'], ENT_QUOTES); ?>')" class="btn btn-primary">Edit</a>
                            <a href="delete_profile_post.php?post_id=<?php echo $post['PostID']; ?>" class="btn btn-danger">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </section>

     <!-- The Modal -->
     <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="mb-4">Edit Post</h2>
            <!-- Form for editing the post -->
            <form id="editForm" action="edit_profile_post.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="editPostID" name="post_id">
                <div class="form-group">
                    <label for="editContent">Content:</label>
                    <textarea id="editContent" name="content" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="editImage">Image:</label>
                    <input type="file" id="editImage" name="image" class="form-control-file">
                </div>
                <input type="submit" value="Save Changes" class="btn btn-primary">
            </form>
        </div>
    </div>


    <!-- JavaScript to handle the modal -->
    <script>
        // Get the modal
        var modal = document.getElementById("editModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        function openEditModal(postId, content) {
            document.getElementById("editPostID").value = postId;
            document.getElementById("editContent").value = content;
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
