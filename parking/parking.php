<?php
session_start();
include_once 'nav1.php';
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="../css/parking.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css">
    
</head>
<body>
    <div class="banner">
        <img class="banner-pic" src="../img/parking.jpg" alt="Gallery Cafe">
        <div class="para">
            <?php if ($message == 'reserved'): ?>
                <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i>Your reservation is successful.</div>
            <?php elseif ($message == 'err'): ?>
                <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i>Something went wrong.</div>
            <?php endif; ?>
            <h1>Gallery Cafe - Parking Area</h1>
            <p>
                Welcome to the Gallery Cafe, where convenience meets comfort. Our dedicated parking area is designed to make your visit as seamless
                 as possible. Located just steps from our entrance, our spacious parking lot ensures you can easily find a spot, even during our 
                 busiest hours. With ample lighting and secure surroundings, you can enjoy your dining experience with peace of mind. Whether
                  you're stopping by for a quick coffee or a leisurely meal, rest assured that parking at the Gallery Cafe is always 
                  hassle-free.
            </p>
            <div class="social">
                <a href="https://github.com/RamithaHeshan33" target="_blank"><i class='bx bxl-github'></i></a>
                <a href="https://www.linkedin.com/in/ramithaheshan/" target="_blank"><i class='bx bxl-linkedin'></i></a>
                <a href="https://www.youtube.com/@RamithaHeshan" target="_blank"><i class='bx bxl-youtube'></i></a>
            </div>
        </div>
    </div>

    <div class="parking">
        <div class="slot-group">
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <div class="slot">
                    <p>SLOT<?= $i ?></p>
                    <img class="icon" src="../img/parking-sign.png" alt="">
                    <!-- Pass slot number to openModal function -->
                    <input type="button" value="Reserve" class="btn2" onclick="openModal(<?= $i ?>)">
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Modal -->
    <div id="reserveModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="reserveForm" action="request_park.php" method="post">
                <!-- Slot number input -->
                <label for="username">Username:</label>
                <input type="text" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" id="id" name="username" placeholder="Enter Your ID" readonly>
                <label for="name">Name:</label>
                <input type="text" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" id="name" name="name" readonly>
                <input type="hidden" id="slotNumberInput" name="slotNumber">
                <label for="vehicleNumber">Vehicle Number:</label>
                <input type="text" id="vehicleNumber" name="vehicleNumber" required>
                <label for="reserveDate">Reserve Date:</label>
                <input type="date" id="reserveDate" name="reserveDate" required>
                <label for="reserveTime">Reserve Time:</label>
                <input type="time" id="reserveTime" name="reserveTime" required>
                <label for="exitDate">Exit Date:</label>
                <input type="date" id="exitDate" name="exitDate" required>
                <label for="exitTime">Exit Time:</label>
                <input type="time" id="exitTime" name="exitTime" required>
                <label for="phone">Phone Number:</label>
                <input type="text" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>" id="phone" name="phone" readonly>
                <input type="submit" name="request_park" value="Reserve">
            </form>
        </div>
    </div>

    <script>
        function openModal(slotNumber) {
            document.getElementById('slotNumberInput').value = slotNumber; // Set slot number in hidden input
            document.getElementById('reserveModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('reserveModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('reserveModal')) {
                closeModal();
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
