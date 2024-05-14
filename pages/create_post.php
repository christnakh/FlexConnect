<?php
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

function generateRandomURL($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomURL = '';
    for ($i = 0; $i < $length; $i++) {
        $randomURL .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomURL;
}

if (isset($_POST['create_post'])) {
    $user_id = $_SESSION['user_id'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $post_date = date('Y-m-d H:i:s');
    $image_url = '';

    if ($_FILES['postImage']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/posts/';
        $image_url = generateRandomURL(8) . '_' . $_FILES['postImage']['name'];

        if (move_uploaded_file($_FILES['postImage']['tmp_name'],  $uploadDir.$image_url)) {
            echo "<script>window.location.reload()</script>";

        } else {
            echo "Move_uploaded_file failed";
        }
    } else {
        echo "File upload failed with error code: " . $_FILES['postImage']['error'];
    }

    $query = "INSERT INTO Posts (UserID, Content, PostDate, ImageURL) 
              VALUES ('$user_id', '$content', '$post_date', '$image_url')";

    if ($conn->query($query) === TRUE) {
        header("Location: create_post.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        textarea,
        input[type="file"] {
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
        
    </style>
</head>
<body>

    <form method="post" action="" enctype="multipart/form-data">
    <a href="profile.php" class="btn btn-secondary mb-3">Back to Profile</a>

        <div class="container mt-4">
            <h2>Create Post</h2>
            <label>Content: <textarea class="form-control" name="content" required></textarea></label>
            <label>Post Image: <input type="file" name="postImage" class="form-control" accept="image/*"></label>

            <input type="submit" name="create_post" value="Create Post" class="btn btn-success">
        </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>