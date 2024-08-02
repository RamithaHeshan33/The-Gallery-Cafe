<?php
// Start the session
session_start();

require 'staff-nav.php';

// Include the database connection
include_once('../connection.php');

// Update status if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['res_number']) && isset($_POST['action'])) {
        $resNumber = $_POST['res_number'];
        $action = $_POST['action'];
        
        if ($action == 'update_status') {
            $status = isset($_POST['status']) ? 'done' : '';
            $updateSql = "UPDATE table_reservation SET status = ? WHERE res_number = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param('ss', $status, $resNumber);
            $updateStmt->execute();
        } elseif ($action == 'delete') {
            $deleteSql = "DELETE FROM table_reservation WHERE res_number = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param('s', $resNumber);
            $deleteStmt->execute();
        }
    }
}

$sql = "SELECT * FROM table_reservation";
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../admin/css/menu.css">
</head>
<body>
    <video autoplay muted loop id="bgVideo">
        <source src="/img/table.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hide">
        <div class="res-container">
            <div class="table-container-2">
                <div class="table">
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Reservation Number</th>
                            <th>Booked Date</th>
                            <th>Booked Time</th>
                            <th>Num of Adults</th>
                            <th>Num of Kids</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                echo "<td data-cell='Status'>";
                                echo "<form method='post' action=''>";
                                echo "<input type='hidden' name='res_number' value='" . htmlspecialchars($row['res_number'], ENT_QUOTES, 'UTF-8') . "'>";
                                echo "<input type='hidden' name='action' value='update_status'>";
                                echo "<input type='checkbox' name='status' value='done' " . ($row['status'] === 'done' ? 'checked' : '') . " onchange='this.form.submit()'>";
                                echo "</form>";
                                echo "</td>";
                                echo "<td data-cell='Action'>";
                                echo "<form method='post' action='' onsubmit='return confirm(\"Are you sure you want to delete this reservation?\")'>";
                                echo "<input type='hidden' name='res_number' value='" . htmlspecialchars($row['res_number'], ENT_QUOTES, 'UTF-8') . "'>";
                                echo "<input type='hidden' name='action' value='delete'>";
                                echo "<input type='submit' value='Delete' class='btn3'>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No Table Reservations</td></tr>";
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
