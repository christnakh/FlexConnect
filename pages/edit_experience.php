<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_experience'])) {
        handleAddExperience($conn, $userID);
    } elseif (isset($_POST['update_experience'])) {
        handleUpdateExperience($conn, $userID);
    } elseif (isset($_POST['remove_experience'])) {
        handleRemoveExperience($conn, $userID);
    }
}

$experienceSql = "SELECT * FROM Experience WHERE UserID = $userID";
$experienceResult = $conn->query($experienceSql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Experience</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Experience</h2>
        <a href="profile.php" class="btn btn-secondary mb-3">Back to Profile</a>

        <h3>Your Experience:</h3>
        <ul class="list-group">
            <?php while ($experience = $experienceResult->fetch_assoc()): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo "{$experience['CompanyName']} - {$experience['Title']}"; ?>
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal<?php echo $experience['ExperienceID']; ?>">Update</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?php echo $experience['ExperienceID']; ?>">Remove</button>
                    </div>
                </li>

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal<?php echo $experience['ExperienceID']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Update Experience</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="experience_id" value="<?php echo $experience['ExperienceID']; ?>">
                                    <label>Company Name: <input type="text" name="company_name" value="<?php echo $experience['CompanyName']; ?>"></label><br>
                                    <label>Title: <input type="text" name="title" value="<?php echo $experience['Title']; ?>"></label><br>
                                    <label>Location: <input type="text" name="location" value="<?php echo $experience['Location']; ?>"></label><br>
                                    <label>Start Date: <input type="date" name="start_date" value="<?php echo $experience['StartDate']; ?>"></label><br>
                                    <label>End Date: <input type="date" name="end_date" value="<?php echo $experience['EndDate']; ?>"></label><br>
                                    <label>Description: <textarea name="description"><?php echo $experience['Description']; ?></textarea></label><br>
                                    <button type="submit" name="update_experience" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="removeModal<?php echo $experience['ExperienceID']; ?>" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="removeModalLabel">Remove Experience</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to remove this experience entry?</p>
                                <form action="" method="post">
                                    <input type="hidden" name="experience_id" value="<?php echo $experience['ExperienceID']; ?>">
                                    <button type="submit" name="remove_experience" class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </ul>

        <div class="mt-4">
            <h3>Add New Experience:</h3>
            <form action="" method="post" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <input type="text" name="company_name" class="form-control" required>
                    <div class="invalid-feedback">Please enter the company name.</div>
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" required>
                    <div class="invalid-feedback">Please enter the title.</div>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" class="form-control" required>
                    <div class="invalid-feedback">Please enter the location.</div>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" class="form-control" required>
                    <div class="invalid-feedback">Please enter a valid start date.</div>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" class="form-control" required>
                    <div class="invalid-feedback">Please enter a valid end date.</div>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" required></textarea>
                    <div class="invalid-feedback">Please enter the description.</div>
                </div>
                <button type="submit" name="add_experience" class="btn btn-success">Add Experience</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>

<?php
function handleAddExperience($conn, $userID) {
    $companyName = $_POST['company_name'];
    $title = $_POST['title'];
    $location = $_POST['location'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $description = $_POST['description'];

    $insertSql = "INSERT INTO Experience (UserID, CompanyName, Title, Location, StartDate, EndDate, Description) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("issssss", $userID, $companyName, $title, $location, $startDate, $endDate, $description);

    if ($stmt->execute()) {
        header("Location: edit_experience.php");
        exit();
    } else {
        echo "Error adding experience: " . $conn->error;
    }
}

function handleUpdateExperience($conn, $userID) {
    $experienceID = $_POST['experience_id'];
    $companyName = $_POST['company_name'];
    $title = $_POST['title'];
    $location = $_POST['location'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $description = $_POST['description'];

    $updateSql = "UPDATE Experience SET 
        CompanyName=?, 
        Title=?, 
        Location=?, 
        StartDate=?, 
        EndDate=?, 
        Description=? 
        WHERE ExperienceID=? AND UserID=?";
    
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssssii", $companyName, $title, $location, $startDate, $endDate, $description, $experienceID, $userID);

    if ($stmt->execute()) {
        header("Location: edit_experience.php");
        exit();
    } else {
        echo "Error updating experience: " . $conn->error;
    }
}

function handleRemoveExperience($conn, $userID) {
    $experienceID = $_POST['experience_id'];

    $deleteSql = "DELETE FROM Experience WHERE ExperienceID=? AND UserID=?";
    
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("ii", $experienceID, $userID);

    if ($stmt->execute()) {
        header("Location: edit_experience.php");
        exit();
    } else {
        echo "Error removing experience: " . $conn->error;
    }
}
?>
