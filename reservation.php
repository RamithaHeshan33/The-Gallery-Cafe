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
    <title>Reservation</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .home {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            display: flex;
            gap: 30px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .form-container-2 {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .form-container-2:hover {
            transform: translateY(-10px);
        }

        .form-content {
            text-align: center;
        }

        .form-content img {
            width: 100%;
            border-radius: 10px;
        }

        .form-content h1 {
            margin-top: 20px;
            font-size: 2rem;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .form-content form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-content form input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .form-content form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="body">
    <div class="home">
        <div class="container">
            <div class="form-container-2">
                <div class="form-content">
                    <form method="POST" action="table-res.php">
                        <img src="img/restaurant.jpg" alt="Restaurant Image">
                        <h1>Table Reservation</h1>
                        <input type="submit" value="Reserve Now">
                    </form>
                </div>
            </div>

            <div class="form-container-2">
                <div class="form-content">
                    <form method="POST" action="parking-res.php">
                        <img src="img/garage.jpg" alt="Garage Image">
                        <h1>Parking Reservation</h1>
                        <input type="submit" value="Reserve Now">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
