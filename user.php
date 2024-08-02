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

</head>
<body class="body">
    <video autoplay muted loop id="bgVideo">
        <source src="/img/intro.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="home-para">
        <button class="login-button" onclick="window.location.href='login.php'">Login</button>
        
    </div>

</body>
</html>
