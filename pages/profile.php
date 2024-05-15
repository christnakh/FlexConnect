<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userSQL = "SELECT * FROM Users WHERE UserID = $userID";
$userResult = $conn->query($userSQL);

if ($userResult->num_rows == 1) {
    $user = $userResult->fetch_assoc();
} else {
    echo "Error fetching user information";
    exit();
}

$skillsSQL = "SELECT * FROM Skills WHERE UserID = $userID";
$skillsResult = $conn->query($skillsSQL);

if ($skillsResult->num_rows > 0) {
    $skills = $skillsResult->fetch_assoc();
} else {
    $skills = array(); 
}

$postsSQL = "SELECT u.*, p.* FROM Users u INNER JOIN Posts p ON u.UserID = p.UserID WHERE u.UserID = $userID";
$postsResult = $conn->query($postsSQL);

if ($postsResult->num_rows > 0) {
    $posts = $postsResult->fetch_assoc();
} else {
    $posts = array(); 
}


$experienceSQL = "SELECT * FROM Experience WHERE UserID = $userID";
$experienceResult = $conn->query($experienceSQL);

if ($experienceResult->num_rows > 0) {
    $experience = $experienceResult->fetch_assoc();
} else {
    $experience = array();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin-top: 20px;
        }

        .jumbotron {
            background-color: #ffffff;
            padding: 2rem 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }

        .card-body .img-fluid {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 5px;
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

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <section class="container">
        <div class="jumbotron mt-5">
            <h1 class="display-4">User Profile</h1>
            <hr class="my-4">
            <?php if (!empty($user['ProfilePictureURL'])): ?>
                <img src="<?php echo $user['ProfilePictureURL']; ?>" alt="Profile Picture" class="profile-img">
            <?php endif; ?>
            <p class="lead">Name: <?php echo $user['Name']; ?></p>
            <p class="lead">Email: <?php echo $user['Email']; ?></p>
            <p class="lead"><a href="create_post.php" class="btn btn-primary">Create Post</a></p>
            <p class="lead"><a href="edit_experience.php" class="btn btn-primary">Edit Experience</a></p>
            <p class="lead"><a href="edit_education.php" class="btn btn-primary">Edit Education</a></p>
            <p class="lead"><a href="edit_skills.php" class="btn btn-primary">Edit Skills</a></p>
            <p class="lead"><a href="edit_profile.php" class="btn btn-primary">Edit Profile</a></p>
            <form action="logout.php" method="post">
                <input type="submit" class="btn btn-danger" value="Logout">
            </form>
            <br> 
            <a href="/" class="btn btn-secondary">Back home</a>
        </div>


        <h1>My Posts</h1>

        <?php if ($postsResult->num_rows > 0): ?>
            <?php while($post = $postsResult->fetch_assoc()): ?>
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $post['Name']; ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($post['Content']); ?></p>
                        <img src="<?php echo '../uploads/posts/'.($post['ImageURL']); ?>" alt="Post Image" class="img-fluid">
                        <br>
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

     <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="mb-4">Edit Post</h2>
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


    <script>
        var modal = document.getElementById("editModal");

        var span = document.getElementsByClassName("close")[0];

        function openEditModal(postId, content) {
            document.getElementById("editPostID").value = postId;
            document.getElementById("editContent").value = content;
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

