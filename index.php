<?php
include "./config/db.php";
include "./includes/header.php";



$userID = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header("Location: pages/login.php");
    exit();
}
$query = "SELECT u.*, p.*, 
          (SELECT COUNT(*) FROM PostInteractions WHERE PostID = p.PostID AND ReactionStatus = 'like') as likes,
          (SELECT COUNT(*) FROM PostInteractions WHERE PostID = p.PostID AND ReactionStatus = 'love') as loves,
          (SELECT COUNT(*) FROM PostInteractions WHERE PostID = p.PostID AND ReactionStatus = 'dislike') as dislikes
          FROM Users as u 
          INNER JOIN Posts as p ON u.UserID = p.UserID;";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching posts: " . mysqli_error($conn));
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Rubik', sans-serif;
        background-color: #f8f9fa;
        color: #343a40;
    }
    .container {
        padding-top: 20px;
        margin-right: 20px;
    }
    .media {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #fff;
    }
    .media img {
        width: 60px; 
        height: 60px;
        object-fit: cover;
        border-radius: 50%; 
        margin-right: 15px;
    }
    .media h5 {
        margin-bottom: 10px;
    }
    .reaction-section {
        margin-top: 15px;
    }
    .reaction {
        margin-right: 10px;
    }
    .reaction-count {
        font-size: 0.9em;
        color: grey;
    }
    .comment-box {
        margin-top: 20px;
    }
    .comment-input {
        margin-bottom: 10px;
    }
    .comments-section p {
        margin-bottom: 5px;
    }
    .edit-comment,
    .delete-comment {
        margin-right: 5px;
    }
    #editCommentModal {
        color: #343a40;
    }
    #editCommentModal .modal-content {
        border-radius: 10px;
    }

    .media .img-fluid {
        width: 100%; 
        border-radius: 0; 
        margin-top: 10px; 
        height:600px
    }
    .comment-box {
        margin-top: 20px;
    }
    .comment-input {
        width: 100%;
        border: 1px solid #dee2e6;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 10px;
    }
    .post-comment {
        background: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }
    .post-comment:hover {
        background: #0056b3;
    }
    .comments-section p {
        padding: 10px;
        background-color: #f0f0f0;
        border-radius: 10px;
        margin-top: 10px;
        line-height: 1.4;
        font-size: 14px;
        position: relative;
    }
    .comments-section strong {
        color: #333;
        font-weight: bold;
    }
    .edit-comment,
    .delete-comment {
        font-size: 12px;
        padding: 3px 8px;
        margin-left: 10px;
        border-radius: 5px;
        background: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }
    .edit-comment {
        background: #4D84E2  ;
    }
    .edit-comment:hover,
    .delete-comment:hover {
        opacity: 0.85;
    }
    .edit-comment:focus,
    .delete-comment:focus {
        outline: none;
    }
    .reaction-section {
        margin-top: 15px;
        display: flex;
        align-items: center;
    }
    .reaction {
        border: none;
        background: none;
        color: inherit;
        font-size: 16px;
        padding: 5px 10px;
        margin-right: 10px;
        cursor: pointer;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease;
    }
    .reaction i {
        margin-right: 5px;
    }
    .reaction.active {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }
    .reaction:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }
    .reaction-count {
        font-size: 0.9em;
        color: grey;
        margin-left: 5px;
    }

    .first-box {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;

            position: fixed;
            top: 5.5%; 
            left: 5%; 
            z-index: 1; 
        }

        .back-profile {
            position: relative;
            text-align: center; 
        }

        .back-pro {
            width: 100%;
            border-radius: 8px; 
            height:100px
        }

        .profile-img {
            width: 80px; 
            position: absolute;
            top: 50px; 
            left: 50%;
            transform: translateX(-50%); 
            background-color: whitesmoke;
            border-radius: 50%;
            padding: 5px;
            z-index: 2;
            height:80px
        }

        .first-box {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 90px;
            padding: 10px;
            width: 400px;
            position: fixed;
            top: 4.5%; 
            right: 75%; 
            height:450px;
            
        }
        @media (max-width: 768px) {
        .container {
            margin-right: 0; 
            padding: 10px; 
        }
        .media {
            padding: 10px; 
        }
        .media img {
            width: 50px; 
            height: 50px; 
        }
        .media .img-fluid {
            height: auto; 
        }
        .reaction, .post-comment {
            padding: 5px 10px; 
            font-size: 14px;
        }
        .comment-input, .comments-section p {
            font-size: 14px; 
        }
        .first-box {
            position: static; 
            width: 100%; 
            margin-top: 20px; 
            padding: 10px; 
            box-shadow: none; 
            border-radius: 0; 
        }
        .profile-img {
            width: 60px; 
            height: 60px; 
            top: -30px; 
        }
        .back-profile img.back-pro {
            height: 150px; 
        }
        .skills_list {
            display: block; 
        }
        .skills_title {
            display: block; 
        }
    }
    
</style>

</head>
<body>
<?php
$que = "SELECT * FROM Users WHERE UserID = $userID";
$resl = mysqli_query($conn, $que);

if ($resl && mysqli_num_rows($resl) > 0) {
    $user = mysqli_fetch_assoc($resl);
} else {
    echo "User not found.";
    exit();
}
?>
<div class="first-box">
    <div class="back-profile">
        <img src="img/baner.jpg" alt="backgopurnd" class="back-pro">
        <img src="<?php echo htmlspecialchars($user['ProfilePictureURL']);?>" alt="profile" class="profile-img">
   </div>

   <div class="about-me">
    <div class="profile-name">
        Welcome, <?php echo htmlspecialchars($user['Name']);?>!
    </div>

   </div>
   <br>

   <p class="viewPro"><a href="pages/profile.php">View Profile</a></p>
</div>
<div class="container">
    <section>
        <?php foreach ($result as $postUser): ?>
            <div class="media">
                <img src="<?php echo $postUser['ProfilePictureURL']; ?>" alt='Profile' class="mr-3 rounded-circle">
                <div class="media-body">
                    <h5><?php echo $postUser['Name']; ?></h5>
                    <p><?php echo $postUser['Content']; ?></p>
                    <img src="<?php echo'/uploads/posts/'. $postUser['ImageURL']; ?>" alt='Image post' class="img-fluid ">
                  <div class="reaction-section mt-2">
    <button class="reaction btn btn-outline-primary <?php echo ($postUser['user_reaction'] == 'like') ? 'active' : ''; ?>" data-post-id="<?php echo $postUser['PostID']; ?>" data-reaction="like">
        <i class="fas fa-thumbs-up"></i>
    </button>
    <span class="reaction-count like-count"><?php echo $postUser['likes']; ?></span>

    <button class="reaction btn btn-outline-success <?php echo ($postUser['user_reaction'] == 'love') ? 'active' : ''; ?>" data-post-id="<?php echo $postUser['PostID']; ?>" data-reaction="love">
        <i class="fas fa-heart"></i>
    </button>
    <span class="reaction-count love-count"><?php echo $postUser['loves']; ?></span>

    <button class="reaction btn btn-outline-danger <?php echo ($postUser['user_reaction'] == 'dislike') ? 'active' : ''; ?>" data-post-id="<?php echo $postUser['PostID']; ?>" data-reaction="dislike">
        <i class="fas fa-thumbs-down"></i> 
    </button>
    <span class="reaction-count dislike-count"><?php echo $postUser['dislikes']; ?></span>
</div>

                    <div class="comment-box">
                        <input type="text" class="form-control comment-input" placeholder="Write a comment..." data-post-id="<?php echo $postUser['PostID']; ?>">
                        <button class="btn btn-primary mt-2 post-comment">Post Comment</button>

                        <div class="comments-section mt-2">
                            <?php
                            $postID = $postUser['PostID'];
                            $commentsQuery = "SELECT c.*, u.Name
                                              FROM Comments c
                                              INNER JOIN Users u ON c.UserID = u.UserID
                                              WHERE c.PostID = $postID";
                            $commentsResult = mysqli_query($conn, $commentsQuery);

                            while ($comment = mysqli_fetch_assoc($commentsResult)) {
                                echo '<p><strong>' . $comment['Name'] . ':</strong> ' . $comment['CommentText'];

                                if ($comment['UserID'] == $userID) {
                                    echo '<button class="btn btn-primary btn-sm edit-comment" data-comment-id="' . $comment['CommentID'] . '" data-comment-text="' . htmlspecialchars($comment['CommentText']) . '">Edit</button>';
                                    echo '<button class="btn btn-danger btn-sm delete-comment" data-comment-id="' . $comment['CommentID'] . '">Delete</button>';
                                }

                                echo '</p>';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateCommentForm">
                    <input type="hidden" id="updateCommentId" name="comment_id">
                    <div class="form-group">
                        <textarea id="updateCommentText" name="comment_text" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>



$(document).ready(function() {
    $('.reaction').click(function() {
        var button = $(this);
        var reaction = button.data('reaction');
        var post_id = button.data('post-id');
        var user_id = <?php echo $userID; ?>;  

        $.ajax({
            url: '/pages/handle_post.php', 
            type: 'POST',
            data: { post_id: post_id, user_id: user_id, reaction: reaction },
            dataType: 'json',
            success: function(data) {
                if (data && !data.error) {
                    var reactionSection = button.closest('.reaction-section');
                    reactionSection.find('.like-count').text(data.likes);
                    reactionSection.find('.love-count').text(data.loves);
                    reactionSection.find('.dislike-count').text(data.dislikes);

                    reactionSection.find('.reaction').removeClass('active');
                    button.addClass('active');
                } else {
                    alert('Error: ' + data.error);
                }
            },
            error: function(xhr, status, error) {
                alert('Error occurred while updating reaction: ' + error);
            }
        });
    });
});


$('.reaction.active').each(function() {
    var button = $(this);
    var reaction = button.data('reaction');
    handleReaction(button, reaction);
});

function handleReaction(button, reaction) {
    var post_id = button.data('post-id');

    $.ajax({
        url: '/pages/handle_post.php',
        type: 'post',
        data: { post_id: post_id, user_id: <?php echo $userID; ?>, reaction: reaction },
        success: function(response) {
            var data = JSON.parse(response);
            var reactionSection = button.closest('.reaction-section');
            reactionSection.find('.like-count').text(data.likes);
            reactionSection.find('.love-count').text(data.loves);
            reactionSection.find('.dislike-count').text(data.dislikes);

            reactionSection.find('.reaction').removeClass('active');

            button.addClass('active');
        },
        error: function() {
            alert('Error occurred while updating reaction.');
        }
    });
}


$('.post-comment').click(function() {
    var commentBox = $(this).siblings('.comment-input');
    var post_id = commentBox.data('post-id');
    var commentText = commentBox.val();

    if (commentText.trim() === '') {
        alert('Please enter a comment.');
        return;
    }

    $.ajax({
        url: './pages/post_comment.php',
        type: 'post',
        data: { post_id: post_id, user_id: <?php echo $userID; ?>, comment_text: commentText },
        success: function(response) {
            if(response.status === 'success') {
                var commentData = response.data;
                var commentHTML = '<p><strong>' + commentData.userName + ':</strong> ' + commentData.commentText;
                commentHTML += '<button class="btn btn-danger btn-sm delete-comment" data-comment-id="' + commentData.commentID + '">Delete</button></p>';

                commentBox.siblings('.comments-section').append(commentHTML);
                commentBox.val(''); 
                   location.reload(); 
            } else {
                alert(response.message);
            }
        }
    });
});

$(document).on('click', '.edit-comment', function() {
    var commentID = $(this).data('comment-id');
    var commentText = $(this).data('comment-text');
    $('#updateCommentId').val(commentID);
    $('#updateCommentText').val(commentText);
    $('#editCommentModal').modal('show');
});

$('#updateCommentForm').submit(function(e) {
    e.preventDefault();
    var commentID = $('#updateCommentId').val();
    var commentText = $('#updateCommentText').val();

    $.ajax({
        url: './pages/update_comment.php', 
        type: 'post',
        data: { comment_id: commentID, comment_text: commentText, user_id: <?php echo $userID; ?> },
        success: function(responxse) {
            location.reload(); 
        },
        error: function() {
            alert('Error occurred while updating comment.');
        }
    });
});

$(document).on('click', '.delete-comment', function() {
    var commentID = $(this).data('comment-id');
    $.ajax({
        url: './pages/delete_comment.php',
        type: 'post',
        data: { comment_id: commentID },
        success: function(response) {
            location.reload(); 
        },
        error: function() {
            alert('Error occurred while deleting comment.');
        }
    });
});

</script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
