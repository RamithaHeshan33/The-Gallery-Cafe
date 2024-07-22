<?php
    session_start();
    require 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="admin/css/menu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Tailwind CSS (required for Flowbite) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- Flowbite CSS -->
    <link href="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="body">
    <video autoplay muted loop id="bgVideo">
        <source src="/img/intro.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="home-para">
        <button class="login-button" onclick="window.location.href='login.php'">Login</button>
        <!-- <div class="para">
            <h2>The Gallery Cafe</h2>
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
        </div> -->
    </div>

</body>
</html>
