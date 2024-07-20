<?php
    session_start();
    // Prevent back button after logout
header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
require 'connection.php';

    require 'nav1.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Tailwind CSS (required for Flowbite) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- Flowbite CSS -->
    <link href="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="body">

    <div class="home">
        <button class="login-button" onclick="window.location.href='user.php'">Logout</button>

        <img class="home-pic" src="img/Untitled-1.jpg" alt="Gallery Cafe">
        <div class="para">
            <h1>The Gallery Cafe</h1>
            <p class="items-justify">
                Welcome to <strong>The Gallery Cafe</strong>, where culinary excellence meets unparalleled hospitality. Nestled in the heart of Kalutara, 
                our restaurant offers a vibrant dining experience that captures the essence of both local and international flavors. From our
                meticulously crafted dishes to our warm, inviting atmosphere, every detail is designed to delight your senses. Whether you're
                joining us for a casual lunch, an intimate dinner, or a special celebration, our dedicated team is committed to making your 
                visit unforgettable. Indulge in our diverse menu, savor our expertly paired wines, and immerse yourself in an ambiance that
                feels like home. Welcome to a place where every meal is a celebration, and every guest is family.
            </p>
            <div class="social items-center space-x-4 mt-4">
                <a href="https://github.com/RamithaHeshan33" target="_blank"><i class='bx bxl-github'></i></a>
                <a href="https://www.linkedin.com/in/ramithaheshan/" target="_blank"><i class='bx bxl-linkedin'></i></a>
                <a href="https://www.youtube.com/@RamithaHeshan" target="_blank"><i class='bx bxl-youtube'></i></a>
            </div>
        </div>
    </div>

</body>
</html>
