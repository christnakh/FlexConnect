<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_education'])) {
        handleAddEducation($conn, $userID);
    } elseif (isset($_POST['update_education'])) {
        handleUpdateEducation($conn, $userID);
    } elseif (isset($_POST['remove_education'])) {
        handleRemoveEducation($conn, $userID);
    }
}

$educationSql = "SELECT * FROM Education WHERE UserID = $userID";
$educationResult = $conn->query($educationSql);

$schoolNameSql = "SELECT * FROM SchoolName";
$schoolNameResult = $conn->query($schoolNameSql);

$degreeSql = "SELECT * FROM Degree";
$degreeResult = $conn->query($degreeSql);

$fieldStudySql = "SELECT * FROM FieldStudy";
$fieldStudyResult = $conn->query($fieldStudySql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Education</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Education</h2>
                 <a href="profile.php" class="btn btn-secondary mb-3">Back to Profile</a>

        <h3>Your Education:</h3>
        <ul class="list-group">
            <?php while ($education = $educationResult->fetch_assoc()): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo "{$education['SchoolName']} - {$education['Degree']}"; ?>
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal<?php echo $education['EducationID']; ?>">Update</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?php echo $education['EducationID']; ?>">Remove</button>
                    </div>
                </li>

                <div class="modal fade" id="updateModal<?php echo $education['EducationID']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Update Education</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="education_id" value="<?php echo $education['EducationID']; ?>">
                                    <label>School Name: <input type="text" name="school_name" value="<?php echo $education['SchoolName']; ?>"></label><br>
                                    <label>Degree: <input type="text" name="degree" value="<?php echo $education['Degree']; ?>"></label><br>
                                    <label>Field of Study: <input type="text" name="field_of_study" value="<?php echo $education['FieldOfStudy']; ?>"></label><br>
                                    <label>Start Year: <input type="number" name="start_year" value="<?php echo $education['StartYear']; ?>"></label><br>
                                    <label>End Year: <input type="number" name="end_year" value="<?php echo $education['EndYear']; ?>"></label><br>
                                    <button type="submit" name="update_education" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="removeModal<?php echo $education['EducationID']; ?>" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="removeModalLabel">Remove Education</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to remove this education entry?</p>
                                <form action="" method="post">
                                    <input type="hidden" name="education_id" value="<?php echo $education['EducationID']; ?>">
                                    <button type="submit" name="remove_education" class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </ul>

        <div class="mt-4">
            <h3>Add New Education:</h3>
            <form action="" method="post" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="school_name">School Name:</label>
                    <select name="school_name" class="form-control" required>
                        <?php
                            if ($schoolNameResult -> num_rows > 0){
                                while ($school = $schoolNameResult->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $school['school_Name']; ?>"><?php echo $school['school_Name']; ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">Please select a school name.</div>
                </div>
                <div class="form-group">
                    <label for="degree">Degree:</label>
                    <select name="degree" class="form-control" required>
                        <?php
                            if ($degreeResult -> num_rows > 0){
                                while ($degree = $degreeResult->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $degree['degree_Type']; ?>"><?php echo $degree['degree_Type']; ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                    
                    <div class="form-group">
                        <label for="field_of_study">Field of Study:</label>
                        <select name="field_of_study" class="form-control" required>
                            <?php
                                if ($fieldStudyResult -> num_rows > 0){
                                    while ($fieldStudy = $fieldStudyResult->fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $fieldStudy['FieldStudyType']; ?>"><?php echo $fieldStudy['FieldStudyType']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="start_year">Start Year:</label>
                    <input type="number" name="start_year" class="form-control" required>
                    <div class="invalid-feedback">Please enter a valid start year.</div>
                </div>
                <div class="form-group">
                    <label for="end_year">End Year:</label>
                    <input type="number" name="end_year" class="form-control" required>
                    <div class="invalid-feedback">Please enter a valid end year.</div>
                </div>
                <button type="submit" name="add_education" class="btn btn-success">Add Education</button>
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
function handleAddEducation($conn, $userID) {
    $schoolName = $_POST['school_name'];
    $degree = $_POST['degree'];
    $fieldOfStudy = $_POST['field_of_study'];
    $startYear = $_POST['start_year'];
    $endYear = $_POST['end_year'];

    $insertSql = "INSERT INTO Education (UserID, SchoolName, Degree, FieldOfStudy, StartYear, EndYear) 
                  VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("isssii", $userID, $schoolName, $degree, $fieldOfStudy, $startYear, $endYear);

    if ($stmt->execute()) {
        header("Location: edit_education.php");
        exit();
    } else {
        echo "Error adding education: " . $conn->error;
    }
}

function handleUpdateEducation($conn, $userID) {
    $educationID = $_POST['education_id'];
    $schoolName = $_POST['school_name'];
    $degree = $_POST['degree'];
    $fieldOfStudy = $_POST['field_of_study'];
    $startYear = $_POST['start_year'];
    $endYear = $_POST['end_year'];

    $updateSql = "UPDATE Education SET 
        SchoolName=?, 
        Degree=?, 
        FieldOfStudy=?, 
        StartYear=?, 
        EndYear=? 
        WHERE EducationID=? AND UserID=?";
    
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sssiisi", $schoolName, $degree, $fieldOfStudy, $startYear, $endYear, $educationID, $userID);

    if ($stmt->execute()) {
        header("Location: edit_education.php");
        exit();
    } else {
        echo "Error updating education: " . $conn->error;
    }
}

function handleRemoveEducation($conn, $userID) {
    $educationID = $_POST['education_id'];

    $deleteSql = "DELETE FROM Education WHERE EducationID=? AND UserID=?";
    
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("ii", $educationID, $userID);

    if ($stmt->execute()) {
        header("Location: edit_education.php");
        exit();
    } else {
        echo "Error removing education: " . $conn->error;
    }
}
?>