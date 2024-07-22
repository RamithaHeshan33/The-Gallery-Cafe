<?php
// Start the session
session_start();

require 'nav1.php';

// Include the database connection
include_once('connection.php');

$username = $_SESSION['username'];
$sql = "SELECT * FROM table_reservation WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
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
    <link rel="stylesheet" href="css/reservation.css">
    <link rel="stylesheet" href="admin/css/menu.css">

</head>
<body>
    <!-- <video autoplay muted loop id="bgVideo">
        <source src="/img/table.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video> -->
    <div class="hide">
        <div class="res-container">
            <div class="table-container-2">
                <div class="table">
                    <table>
                        <tr>
                            <th>username</th>
                            <th>Name</th>
                            <th>Reservation Number</th>
                            <th>Booked Date</th>
                            <th>Booked Time</th>
                            <th>Number of Adults</th>
                            <th>Number of Kids</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td data-cell='Username'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Name'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Reservation Number'>" . htmlspecialchars($row['res_number'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Booked Date'>" . htmlspecialchars($row['book-date'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Booked Time'>" . htmlspecialchars($row['book-time'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Number of Adults'>" . htmlspecialchars($row['adults'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Number of Kids'>" . htmlspecialchars($row['kids'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Phone'>" . htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Status'>" . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "</tr>";

                            }
                        } else {
                            echo "<tr><td colspan='5'>No Table Reservations</td></tr>";
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
    </div>
    
</body>
</html>
