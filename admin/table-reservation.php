<?php
// Start the session
session_start();

require 'admin-nav.php';

// Include the database connection
include_once('../connection.php');

// Update status if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['res_number'])) {
    $resNumber = $_POST['res_number'];
    $status = isset($_POST['status']) ? 'done' : '';

    $updateSql = "UPDATE table_reservation SET status = ? WHERE res_number = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param('ss', $status, $resNumber);
    $updateStmt->execute();
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
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
    
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
                            echo "<td data-cell='Status'>";
                            echo "<form method='post' action=''>";
                            echo "<input type='hidden' name='res_number' value='" . htmlspecialchars($row['res_number'], ENT_QUOTES, 'UTF-8') . "'>";
                            echo "<input type='checkbox' name='status' value='done' " . ($row['status'] === 'done' ? 'checked' : '') . " onchange='this.form.submit()'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No Table Reservations</td></tr>";
                    }
                    $conn->close();
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
