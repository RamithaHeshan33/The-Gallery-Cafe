<?php
require 'admin-nav.php';
require '../connection.php';

$sql = "SELECT COUNT(*) AS user_count FROM users";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$user_count = $row['user_count'];

$sql = "SELECT COUNT(*) AS table_count FROM table_reservation WHERE status = ''";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$table_count = $row['table_count'];

$sql = "SELECT COUNT(*) AS staff_count FROM staff";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$staff_count = $row['staff_count'];

$sql = "SELECT COUNT(DISTINCT username) AS order_count FROM orders WHERE status = ''";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$order_count = $row['order_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        };
        setTimeout("preventBack()", 0);
        window.onunload = function() {null;}

    </script> -->
</head>
<body>
    <div class="parking">
        <div class="slot-group">
            
            <div class="slot user">
                <p>Number of Users</p>
                <h1 class="card_value"><?php echo $user_count; ?></h1>
                <input type="button" value="Visit Page" id="reserveTableBtn" class="btn2">

            </div>

            <div class="slot table">
                <p>Number of Table Reservations</p>
                <h1 class="card_value"><?php echo $table_count; ?></h1>
                <input type="button" value="Visit Page" id="reserveTableBtn" class="btn2">

            </div>

            <div class="slot member">
                <p>Number of Staff Members</p>
                <h1 class="card_value"><?php echo $staff_count; ?></h1>
                <input type="button" value="Visit Page" id="reserveTableBtn" class="btn2">

            </div>

            <div class="slot food">
                <p>Number of Food Orders</p>
                <h1 class="card_value"><?php echo $order_count; ?></h1>
                <input type="button" value="Visit Page" id="reserveTableBtn" class="btn2">

            </div>

        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
