<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_skill'])) {
        handleAddSkill($conn, $userID);
    } elseif (isset($_POST['update_skill'])) {
        handleUpdateSkill($conn, $userID);
    } elseif (isset($_POST['remove_skill'])) {
        handleRemoveSkill($conn, $userID);
    }
}

$skillsSql = "SELECT * FROM Skills WHERE UserID = $userID";
$skillsResult = $conn->query($skillsSql);

$selectSkills = "SELECT * FROM developerSkills";
$resultSkills = $conn->query($selectSkills);


$updateResultSkills = $conn->query($selectSkills);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Skills</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Skills</h2>
        <a href="profile.php" class="btn btn-secondary mb-3">Back to Profile</a>

        <h3>Your Skills:</h3>
        <ul class="list-group">
            <?php while ($skill = $skillsResult->fetch_assoc()): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $skill['SkillName']; ?>
                    <div class="btn-group" role="group">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal<?php echo $skill['SkillID']; ?>">Update</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#removeModal<?php echo $skill['SkillID']; ?>">Remove</button>
                    </div>
                </li>

                <div class="modal fade" id="updateModal<?php echo $skill['SkillID']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Update Skill</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="skill_id" value="<?php echo $skill['SkillID']; ?>">
                                    
                                    <!-- Skill Name Dropdown -->
                                    <div class="form-group">
                                        <label for="skill_name">Skill Name:</label>
                                        <select name="skill_name" class="form-control" required>
                                            <?php
                                                $selectedSkillName = $skill['SkillName'];
                                                if ($updateResultSkills->num_rows > 0) {
                                                    while ($skillData = $updateResultSkills->fetch_assoc()) {
                                                        $selected = ($skillData['skills_type'] == $selectedSkillName) ? 'selected' : '';
                                                        echo "<option value=\"{$skillData['skills_type']}\" {$selected}>{$skillData['skills_type']}</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Please select a skill name.</div>
                                    </div>

                                    <button type="submit" name="update_skill" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="removeModal<?php echo $skill['SkillID']; ?>" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="removeModalLabel">Remove Skill</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to remove this skill entry?</p>
                                <form action="" method="post">
                                    <input type="hidden" name="skill_id" value="<?php echo $skill['SkillID']; ?>">
                                    <button type="submit" name="remove_skill" class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </ul>

        <div class="mt-4">
            <h3>Add New Skill:</h3>
            <form action="" method="post" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="skill_name">Skill Name:</label>
                    <select name="skill_name" class="form-control" required>
                        <?php
                            if ($resultSkills->num_rows > 0) {
                                while ($skill = $resultSkills->fetch_assoc()) {
                                    echo '<option value="' . $skill['skills_type'] . '">' . $skill['skills_type'] . '</option>';
                                }
                            } else {
                                echo 'No skills found in the database.';
                            }
                            
                        ?>
                    </select>
                </div>

                <button type="submit" name="add_skill" class="btn btn-success">Add Skill</button>
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
function handleAddSkill($conn, $userID) {
    $skillName = $_POST['skill_name'];

    $insertSql = "INSERT INTO Skills (UserID, SkillName) VALUES (?, ?)";
    
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("is", $userID, $skillName);

    if ($stmt->execute()) {
        header("Location: edit_skills.php");
        exit();
    } else {
        echo "Error adding skill: " . $conn->error;
    }
}

function handleUpdateSkill($conn, $userID) {
    $skillID = $_POST['skill_id'];
    $skillName = $_POST['skill_name'];

    $updateSql = "UPDATE Skills SET SkillName=? WHERE SkillID=? AND UserID=?";
    
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sii", $skillName, $skillID, $userID);

    if ($stmt->execute()) {
        header("Location: edit_skills.php");
        exit();
    } else {
        echo "Error updating skill: " . $conn->error;
    }
}

function handleRemoveSkill($conn, $userID) {
    $skillID = $_POST['skill_id'];

    $deleteSql = "DELETE FROM Skills WHERE SkillID=? AND UserID=?";
    
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("ii", $skillID, $userID);

    if ($stmt->execute()) {
        header("Location: edit_skills.php");
        exit();
    } else {
        echo "Error removing skill: " . $conn->error;
    }
}
?>
