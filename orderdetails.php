<?php
session_start();
require 'nav1.php';
include_once('connection.php');

$username = $_SESSION['username'];
$sql = "SELECT * FROM orders WHERE username = ?";
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
    <title>Manage Orders</title>
    <link rel="stylesheet" href="css/reservation.css">
    <link rel="stylesheet" href="admin/css/menu.css">
</head>
<body>
    <div class="hide">
        <div class="res-container">
            <div class="table-container-2">
                <div class="table">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Order Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td data-cell='ID'>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Username'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Order Name'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Price'>" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Quantity'>" . htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Status'>" . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td data-cell='Action'>";
                                echo "<form method='POST' action='delete_order.php' onsubmit='return confirm(\"Are you sure you want to delete this order?\");'>";
                                echo "<input type='hidden' name='order_id' value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>";
                                echo "<input type='submit' value='Delete' class='btn3'>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Orders</td></tr>";
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
