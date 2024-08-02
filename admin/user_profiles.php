<?php
// Start the session
session_start();

require 'admin-nav.php';

// Include the database connection
include_once('../connection.php');

$sql = "SELECT id, username, name, email, phone, dob, nic FROM users"; // Updated query
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
<div class="hide">
    <div class="res-container">
        <div class="table-container-2">
            <div class="table">
                <table>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Date of Birth</th>
                        <th>NIC</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-cell='Username'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Name'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Email'>" . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Phone'>" . htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='DOB'>" . htmlspecialchars($row['dob'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='NIC'>" . htmlspecialchars($row['nic'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td data-cell='Action'>
                                    <form method='post' action='delete_user.php' onsubmit='return confirm(\"Are you sure you want to delete this user?\");'>
                                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>
                                        <button type='submit' class='btn3'>Delete</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No Users Found</td></tr>";
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
