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
    <link rel="stylesheet" href="../admin/css/menu.css">
</head>
<body>
<video autoplay muted loop id="bgVideo">
        <source src="/img/parking.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hide">
        <div class="res-container">
            <div class="table-container-2">
                <div class="table">
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>Parking Slot Number</th>
                            <th>Reserve Date</th>
                            <th>Reserved Time</th>
                            <th>Exit Date</th>
                            <th>Exit Time</th>
                            <th>Phone Number</th>
                            <th>Action</th>
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
                                echo "<td data-cell='Phone'>" . htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Action'>
                                        <form method='post' action='delete_reservation.php' onsubmit='return confirm(\"Are you sure you want to delete this reservation?\");'>
                                            <input type='hidden' name='slot_number' value='" . htmlspecialchars($row['slot_number'], ENT_QUOTES, 'UTF-8') . "'>
                                            <input type='hidden' name='reserve_date' value='" . htmlspecialchars($row['reserve_date'], ENT_QUOTES, 'UTF-8') . "'>
                                            <input type='hidden' name='reserve_time' value='" . htmlspecialchars($row['reserve_time'], ENT_QUOTES, 'UTF-8') . "'>
                                            <input type='hidden' name='username' value='" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "'>
                                            <input type='hidden' name='phone' value='" . htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') . "'>
                                            <button type='submit' class='btn3'>Delete</button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No Parking Reservations</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>