<?php
    require 'admin-nav.php';
    require '../connection.php';

    $message = isset($_GET['message']) ? $_GET['message'] : '';

    $sql = "SELECT * FROM staff";
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
    <title>Document</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/staff.css">
    <link rel="stylesheet" href="../css/reservation.css">
</head>
<body class="body">
<div class="menu">
    <video autoplay muted loop id="bgVideo">
        <source src="/img/staff.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="message-container">
        <?php if ($message == 'submitted'): ?>
            <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i>Staff member is successfully added.</div>
        <?php elseif ($message == 'err'): ?>
            <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i>Something went wrong.</div>
        <?php elseif ($message == 'update'): ?>
            <div class="alert alert-success" id="alertMessage"><i class="fas fa-times-circle"></i>Staff member is updated successfully.</div>
        <?php elseif ($message == 'delete'): ?>
            <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i>Staff member is deleted successfully.</div>
        <?php endif; ?>
    </div>
    <div class="para">
        <form action="save_staff.php" method="POST">
            <div class="form-container">
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" id="position" name="position" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="batch view-link">Add Staff Member</button>
        </form>
    </div>
</div>

<div class="staff">
<h1>Staff Members</h1>
    <div class="table-container-2">
        <div class="table">
            <table>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-cell='Username'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Name'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Position'>" . htmlspecialchars($row['position'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Age'>" . htmlspecialchars($row['age'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Email'>" . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Phone'>" . htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Address'>" . htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Actions' class='btns'>
                                <form method='post' action='update_staff.php' style='display:inline-block;'>
                                    <input type='hidden' name='staff_id' value='" . $row['id'] . "'>
                                    <input type='submit' value='Update' class='btn1'>
                                </form>
                                <form method='post' action='delete_staff.php' style='display:inline-block;'>
                                    <input type='hidden' name='staff_id' value='" . $row['id'] . "'>
                                    <input type='submit' value='Delete' class='btn3'>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No staff members found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

<script>
    setTimeout(function() {
            var alertMessage = document.getElementById('alertMessage');
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
        }, 10000);
</script>
</html>
