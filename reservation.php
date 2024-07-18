<?php
session_start();

require 'nav1.php';
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reservation.css">
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
                    <img src="img/restaurant.jpg" alt="Restaurant Image">
                    <h1>Table Reservation</h1>
                    <input type="button" value="Reserve Now" id="reserveTableBtn" class="btn2">
                </div>
            </div>

            <div class="form-container-2">
                <div class="form-content">
                    <form method="POST" action="parking-res.php">
                        <img src="img/garage.jpg" alt="Garage Image">
                        <h1>Parking Reservation</h1>
                        <a href="parking.php"><input type="button" value="Reserve Now" id="reserveParkingBtn" class="btn2"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="tableReservationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="POST" action="table-res.php">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <input type="date" name="booking_date" placeholder="Booking Date" required>
                <input type="time" name="booking_time" placeholder="Booking Time" required>
                <input type="number" name="adults" placeholder="Number of Adults" required>
                <input type="number" name="kids" placeholder="Number of Kids" required>
                <input type="submit" value="Reserve Table">
            </form>
        </div>
    </div>

    

    <script>
        // Get the modal
        var modal = document.getElementById("tableReservationModal");

        // Get the button that opens the modal
        var btn = document.getElementById("reserveTableBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

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
