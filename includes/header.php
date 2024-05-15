<?php
    include '../config/db.php';

    $sqlProfile = "SELECT ProfilePictureUrl FROM Users WHERE UserId = $_SESSION[user_id]";
    $result = $conn -> query($sqlProfile);

    if ($result) {
    
        if ($result->num_rows > 0) {
    
            $row = $result->fetch_assoc();
    
            $profilePictureUrl = $row['ProfilePictureUrl'];
        }
    
        $result->close();
    } else {
        echo "Error executing the query: " . $conn->error;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keyword" content="">
    <meta name="description" content="">
    <meta name="keywords" content="FlexConnect, job posting, job search, professional networking, career opportunities, employment, resume, CV, job board, career development, LinkedIn alternative, job portal, recruitment, hiring, professional connections, job seekers, employers, talent acquisition, career advice, job market, online job search, job applications, business networking, freelance jobs, full-time jobs, part-time jobs, internships, job alerts, professional profile, job listings">
    <script src="https://kit.fontawesome.com/3ff35f48ba.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="png" href="/img/logo.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Rubik:wght@300&display=swap');

        body {
            font-family: 'Kanit', sans-serif;
            background-color: whitesmoke;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings: "wdth" 100;
            padding-top: 110px;
        }

        header {
            display: flex;
            background-color: #ffffff;
            justify-content: space-around;
        }

        .linked-logo img {
            width: 100%;
            height: 100%;
            cursor: pointer;
            border-radius: 10px;
        }

        .input input {
            height: 37px;
            margin-top: 11px;
            width: 500px;
            margin-left: 5px;
            border-radius: 5px;
            outline: none;
            color: black;
            font-size: 20px;
            background-color: #ffffffc7;
        }

        ul {
            display: flex;
            align-items: center;
        }

        ul li {
            margin: 0px 10px;
            list-style: none;
        }

        ul li a {
            text-decoration: none;
            color: rgb(255, 255, 255);
        }

        ul li a:hover {
            color: rgb(220, 220, 220);
        }

        .fa-solid:hover {
            color: rgb(220, 220, 220);
            cursor: pointer;
        }

        .mid {
            margin: 20px auto;
            padding: 10px;
        }

      

        .profile-picture {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .page-name {
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }

        .posting-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
        }

        .post-actions {
            display: flex;
            border-top: 1px solid #eee;
            padding: 10px;
        }

        .action-button {
            color: #000000;
            padding: 10px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .search__input {
            font-family: inherit;
            font-size: inherit;
            background-color: #f4f2f2;
            border: none;
            color: #646464;
            padding: 0.7rem 1rem;
            border-radius: 5px;
            width: 20em;
            transition: all ease-in-out .5s;
            margin-left: 5rem;
        }

        .search__input:hover,
        .search__input:focus {
            box-shadow: 0 0 1em #00000013;
        }

        .search__input:focus {
            outline: none;
            background-color: #f0eeee;
        }

        .search__input::-webkit-input-placeholder {
            font-weight: 100;
            color: #ccc;
        }

        .search__input:focus+.search__button {
            background-color: #f0eeee;
        }

        .search__button {
            border: none;
            background-color: #f4f2f2;
            margin-top: .1em;
            margin-left: -2rem;
        }

        .search__button:hover {
            cursor: pointer;
        }

        .search__icon {
            height: 1.3em;
            width: 1.3em;
            fill: #000;
            margin-left:-10px;
        }

        .user-nav-profile {
            width: 55px;
            height: 55px;
            margin-top: 30px;
        }

        .navbar-brand img {
            width: 60px;
            height: 60px;
        }

        .navbar-nav {
            margin: auto;
           
        }

        .navbar-nav .nav-item {
            font-size: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
            justify-content: space-evenly;
            padding:0 10px 0 0 ;
        }

        .navbar-nav .nav-item i {
            margin-right: 5px;
            margin-top: auto;
            margin-bottom: auto;
        }

        .navbar-nav .nav-item a {
            display: flex;
            align-items: center;
        }
        
      
        .first-box {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 90px;
            padding: 10px;
            width: 340px;
            position: fixed;
            top: 5.5%; 
            right: 75%; 
            height:380px;
            
        }

        @media (max-width: 768px) {
           
            .mid {
                flex-direction: column;
            }

            .navbar-nav .nav-item i {
                display: none;
            }

            .navbar-nav .nav-item .user-nav-profile {
                display: none;
            }

            .search .search__input {
                width: 190px;
                align-items: center;
                margin-left: -1.5rem;
            }
            
        }
       
        .first-box {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: 340px;
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
        }

.about-me{
    margin-top: 20px;
    text-align: center;
}
.profile-name{
    padding: 25px;
    font-size: 25px;
    font-weight: bold;
}
nav.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1030; 
}
.viewPro{
    text-align: center;
    padding: 10px;
    background-color: #0056b3;
    border-radius: 25px;
    margin-top: 20px;
}
.viewPro a{
    color:white;
}

    </style>
</head>

<body>

<div class="footer">
    <div class="social">
        
    </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="../index.php">
            <img src="../img/logo.png" alt="JobConnectSocial Logo" width="50" height="50">
        </a>

        <div class="search">
            <input type="text" class="search__input" placeholder="Search for People">
            <button class="search__button">
                <i class="fa-solid fa-search search__icon"></i>
            </button>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                <a class="nav-link" href="../index.php">
                    <i class="fa-solid fa-home"></i>
                  Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="pages/jobs.php">
                    <i class="fa-solid fa-briefcase"></i>
                   Jobs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="pages/message.php">
                    <i class="fa-solid fa-message"></i>
                  Messages</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="pages/Notification.php">
                    <i class="fa-solid fa-bell"></i>
                   Notifications</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="pages/profile.php">
                    <i class="fa-solid fa-user"></i>
                   Profile</a>
                </li>
            </ul>
        </div>
    </nav>
 

    
    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
