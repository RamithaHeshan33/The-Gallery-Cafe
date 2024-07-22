<?php
require 'staff-nav.php';
// Include the database connection
include_once('../connection.php');

// Update status if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    if (isset($_POST['status'])) {
        $status = $_POST['status'] === 'done' ? 'done' : '';
        $updateSql = "UPDATE orders SET status = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('si', $status, $id);
        $updateStmt->execute();
    } elseif (isset($_POST['delete'])) {
        $deleteSql = "DELETE FROM orders WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param('i', $id);
        $deleteStmt->execute();
    }
}

$sql = "SELECT * FROM orders";
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
    <link rel="stylesheet" href="../css/reservation.css">
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
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-cell='Username'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Name'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Price'>" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Quantity'>" . htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Status'>";
                            echo "<form method='post' action=''>";
                            echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>";
                            echo "<input type='hidden' name='status' value='" . ($row['status'] === 'done' ? '' : 'done') . "'>";
                            echo "<input type='checkbox' name='status' value='done' " . ($row['status'] === 'done' ? 'checked' : '') . " onchange='this.form.submit()'>";
                            echo "</form>";
                            echo "</td>";
                            echo "<td data-cell='Actions'>";
                            echo "<form method='post' action='' onsubmit='return confirm(\"Are you sure you want to delete this order?\")'>";
                            echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>";
                            echo "<input type='hidden' name='delete' value='1'>";
                            echo "<button type='submit' class='btn3'>Delete</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No Orders</td></tr>";
                    }
                    $conn->close();
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
