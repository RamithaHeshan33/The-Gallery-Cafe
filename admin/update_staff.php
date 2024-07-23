<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_id = $_POST['staff_id'];

    // Fetch the current details of the staff member
    $sql = "SELECT * FROM staff WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $staff = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff Member</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/staff.css">
    <link rel="stylesheet" href="../css/reservation.css">
</head>
<body>
<div class="menu">
    <div class="para">
        <form action="save_update_staff.php" method="POST">
            <input type="hidden" name="staff_id" value="<?php echo $staff['id']; ?>">
            <div class="form-container">
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($staff['username'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($staff['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                        <small>Leave blank to keep the current password.</small>
                    </div>
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" id="position" name="position" value="<?php echo htmlspecialchars($staff['position'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($staff['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($staff['phone'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($staff['age'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($staff['address'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="batch view-link">Update Staff Member</button>
        </form>
    </div>
</div>
</body>
</html>
