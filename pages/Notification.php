<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-btn {
            margin-right: auto;
        }

        .notification-title {
            margin-right: auto;
        }

        .list-group {
            width: 100%;
            max-width: 2000px;
        }

        .list-group-item {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="javascript:history.back()" class="btn btn-primary back-btn">&laquo; Back</a>
            <h1 class="text-center mb-0 notification-title">Notifications</h1>
        </div>

        <?php
        include "../config/db.php";

        // Check if user_id is set in session
        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id'];
            $sql = "SELECT * FROM `Notification` WHERE ReceiverUserID = $userID ORDER BY Timestamp DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="list-group">';
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="#" class="list-group-item list-group-item-action">';
                    echo '<div class="d-flex w-100 justify-content-between">';
                    echo '<h5 class="mb-1">Notification</h5>';
                    echo '<small>' . $row['Timestamp'] . '</small>';
                    echo '</div>';
                    echo '<p class="mb-1">' . $row['NotificationMessage'] . '</p>';
                    echo '</a>';
                }
                echo '</div>';
            } else {
                echo '<div class="alert alert-info" role="alert">';
                echo 'No notifications found.';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo 'User ID not set. Please log in.';
            echo '</div>';
        }

        $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
