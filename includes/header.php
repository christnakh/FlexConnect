<?php
    include '../config/db.php';

    $sqlProfile = "SELECT ProfilePictureUrl FROM Users WHERE UserId = $_SESSION[user_id]";
    $result = $conn -> query($sqlProfile);

    if ($result) {
        // Check if the query was successful
    
        if ($result->num_rows > 0) {
            // Check if there are rows returned
    
            // Fetch the data
            $row = $result->fetch_assoc();
    
            // Access the profile picture URL
            $profilePictureUrl = $row['ProfilePictureUrl'];
        }
    
        // Close the result set
        $result->close();
    } else {
        // Handle the case where the query was not successful
        echo "Error executing the query: " . $conn->error;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="Header d-flex justify-content-between">
        <div class="logo">
           <img src="../img/logo.jpg" alt="">
        </div>

        <div class="">
            <input type='search' name='searchBarHeader' placeholder='Search'>
        </div>

        <div class="LinksHeader">
            <ul class='d-flex justify-content-between'>
                <li><a href='../index.php'>Home</a></li>
                <li><a href='pages/jobs.php'>Jobs</a></li>
                <li><a href=''>Message</a></li> 
                <li><a href=''>Notifications</a></li>
                <li><a href='../pages/logout.php'>Logout</a></li>
                <li><a href="pages/profile.php"><img src="../<?php echo $profilePictureUrl; ?>" alt=""></a></li>
            </ul>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>