<?php
    session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
require 'nav1.php';
require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="./admin/css/menu.css">

</head>
<body class="body">
    <div class="hide">
        <video autoplay muted loop id="bgVideo">
            <source src="/img/intro.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="home-para">
            <button class="login-button" onclick="window.location.href='user.php'">Logout</button>
            <div class="para1">
                <h2>The Gallery Cafe</h2>
                <p class="items-justify">
                    Welcome to <strong>The Gallery Cafe</strong>, where culinary excellence meets unparalleled hospitality. Nestled in the heart of Colombo, 
                    our restaurant offers a vibrant dining experience that captures the essence of both local and international flavors. From our
                    meticulously crafted dishes to our warm, inviting atmosphere, every detail is designed to delight your senses. Whether you're
                    joining us for a casual lunch, an intimate dinner, or a special celebration, our dedicated team is committed to making your 
                    visit unforgettable. Indulge in our diverse menu, savor our expertly paired wines, and immerse yourself in an ambiance that
                    feels like home. Welcome to a place where every meal is a celebration, and every guest is family.
                </p>
                <div class="social">
                    <a href="https://github.com/RamithaHeshan33" target="_blank"><i class='bx bxl-github github'></i></a>
                    <a href="https://www.linkedin.com/in/ramithaheshan/" target="_blank"><i class='bx bxl-linkedin linkedin'></i></a>
                    <a href="https://www.youtube.com/@RamithaHeshan" target="_blank"><i class='bx bxl-youtube youtube'></i></a>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>
