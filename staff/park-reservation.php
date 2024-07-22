<?php
// Start the session
session_start();

require 'staff-nav.php';

// Include the database connection
include_once('../connection.php');

$sql = "SELECT * FROM parking_reservation";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reserved Books</title>
    <link rel="stylesheet" href="../css/reservation.css">
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
    
    <div class="res-container">
        <div class="table-container-2">
            <div class="table">
                <table>
                    <tr>
                        <th>username</th>
                        <th>Parking Slot Number</th>
                        <th>Reserve Date</th>
                        <th>Reserved Time</th>
                        <th>Exit Date</th>
                        <th>Exit Time</th>
                        <th>Phone Number</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-cell='Username'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Slot Number'>" . htmlspecialchars($row['slot_number'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Reserved Date'>" . htmlspecialchars($row['reserve_date'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Reserved Time'>" . htmlspecialchars($row['reserve_time'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Exit Date'>" . htmlspecialchars($row['exit_date'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Exit Time'>" . htmlspecialchars($row['exit_time'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='phone'>" . htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "</tr>";

                        }
                    } else {
                        echo "<tr><td colspan='5'>No Parking Reservations</td></tr>";
                    }
                    $conn->close();
                    ?>
                </table>
            </div>
            <!-- <div class="img">
                <img src="img/parking.jpg" alt="">
            </div> -->
        </div>
    </div>
</body>
</html>
