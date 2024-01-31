<?php
include "./config/db.php";
include "./includes/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: pages/login.php");
    exit();
}

$userID = $_SESSION['user_id'];

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

    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            padding-top: 20px;
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
    </style>
</head>
<body>

<div class="container">
    <section>
        <?php foreach ($result as $postUser): ?>
            <div class="media">
                <img src="../<?php echo $postUser['ProfilePictureURL']; ?>" alt='Profile' class="mr-3 rounded-circle">
                <div class="media-body">
                    <h5><?php echo $postUser['Name']; ?></h5>
                    <p><?php echo $postUser['Content']; ?></p>
                    <img src="../<?php echo $postUser['ImageURL']; ?>" alt='Image post' class="img-fluid">
                  <div class="reaction-section mt-2">
    <button class="reaction btn btn-outline-primary <?php echo ($postUser['user_reaction'] == 'like') ? 'active' : ''; ?>" data-post-id="<?php echo $postUser['PostID']; ?>" data-reaction="like">
        <i class="fas fa-thumbs-up"></i> Like
    </button>
    <span class="reaction-count like-count"><?php echo $postUser['likes']; ?></span>

    <button class="reaction btn btn-outline-success <?php echo ($postUser['user_reaction'] == 'love') ? 'active' : ''; ?>" data-post-id="<?php echo $postUser['PostID']; ?>" data-reaction="love">
        <i class="fas fa-heart"></i> Love
    </button>
    <span class="reaction-count love-count"><?php echo $postUser['loves']; ?></span>

    <button class="reaction btn btn-outline-danger <?php echo ($postUser['user_reaction'] == 'dislike') ? 'active' : ''; ?>" data-post-id="<?php echo $postUser['PostID']; ?>" data-reaction="dislike">
        <i class="fas fa-thumbs-down"></i> Dislike
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

                           // Inside the loop where you generate comments
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

$('.reaction').click(function(){
    var button = $(this);
    var reaction = button.data('reaction');

    // Check if the button is already active
    if (!button.hasClass('active')) {
        // If not active, handle the reaction
        handleReaction(button, reaction);
    }
});

// Call the handleReaction function on page load to set the active class for previous reactions
$('.reaction.active').each(function() {
    var button = $(this);
    var reaction = button.data('reaction');
    handleReaction(button, reaction);
});

function handleReaction(button, reaction) {
    var post_id = button.data('post-id');

    $.ajax({
        url: './pages/handle_post.php',
        type: 'post',
        data: { post_id: post_id, user_id: <?php echo $userID; ?>, reaction: reaction },
        success: function(response) {
            var data = JSON.parse(response);
            var reactionSection = button.closest('.reaction-section');
            reactionSection.find('.like-count').text(data.likes);
            reactionSection.find('.love-count').text(data.loves);
            reactionSection.find('.dislike-count').text(data.dislikes);

            // Remove 'active' class from all buttons in the current reaction section
            reactionSection.find('.reaction').removeClass('active');

            // Add 'active' class to the clicked button
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
                commentBox.val(''); // Clear the comment input box
                   location.reload(); // Refresh the page
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
        url: './pages/update_comment.php', // URL to your PHP script for updating comments
        type: 'post',
        data: { comment_id: commentID, comment_text: commentText, user_id: <?php echo $userID; ?> },
        success: function(response) {
            location.reload(); // Refresh the page
        },
        error: function() {
            alert('Error occurred while updating comment.');
        }
    });
});

// Delete comment functionality
$(document).on('click', '.delete-comment', function() {
    var commentID = $(this).data('comment-id');
    $.ajax({
        url: './pages/delete_comment.php',
        type: 'post',
        data: { comment_id: commentID },
        success: function(response) {
            location.reload(); // Refresh the page
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
