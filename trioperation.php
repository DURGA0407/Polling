<?php 
    session_start ();
    if(!isset($_SESSION["login"]))
    
        header("location:login.php"); 
    ?>
    
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        *{text-decoration: none;font-size:25px;}
        a{color:#fff;}
        .navbar
        {
            width:100%;
            background-color: #555;
            overflow:auto;
        }
        .navbar a {
            float: left;
            padding: 12px;
            color: white;
            text-decoration: none;
            font-size: 17px;
            width: 31.7%; 
            text-align: center;
        }
        .navbar a:hover 
        {
            background-color: #000;
        }

        @media screen and (max-width: 500px)
        {
            .navbar a 
            {
                float: none;
                display: block;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="newpage.php">Create Poll &ensp;<i class="fa-solid fa-plus" style="color: #f5f7fa;"></i></a>
        <a href="final_dashboard.php">Dashboard &ensp;<i class="fa-sharp fa-solid fa-square-poll-vertical" style="color: #e0e6f0;"></i></a>
        <a href="logout.php">Logout <i class="fa-solid fa-arrow-right-from-bracket" style="color: #f4f7fa;"></i></a>
    </div>

    
</body>