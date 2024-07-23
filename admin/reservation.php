<?php
session_start();

require 'admin-nav.php';
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body class="body">
    <div class="home">
        <div class="container">
            <div class="message-container">
                <?php if ($message == 'submitted'): ?>
                    <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i>Your reservation is successful.</div>
                <?php elseif ($message == 'err'): ?>
                    <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i>Something went wrong.</div>
                <?php endif; ?>
            </div>

            <div class="form-container-2">
                <div class="form-content">
                    <img src="../img/restaurant.jpg" alt="Restaurant Image">
                    <h1>Table Reservation</h1>
                    <a href="table-reservation.php"><input type="button" value="Check" id="reserveTableBtn" class="btn2"></a>
                </div>
            </div>

            <div class="form-container-2">
                <div class="form-content">
                    <form method="POST" action="parking-res.php">
                        <img src="../img/garage.jpg" alt="Garage Image">
                        <h1>Parking Reservation</h1>
                        <a href="park-reservation.php"><input type="button" value="Check" id="reserveParkingBtn" class="btn2"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        // Hide the alert message after 10 seconds
        setTimeout(function() {
            var alertMessage = document.getElementById('alertMessage');
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
        }, 10000);
    </script>
</body>
</html>
