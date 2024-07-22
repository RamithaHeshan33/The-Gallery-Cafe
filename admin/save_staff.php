<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_username = $_POST['username'];
    $staff_name = $_POST['name'];
    $staff_password = $_POST['password'];
    $staff_age = $_POST['age'];
    $staff_email = $_POST['email'];
    $staff_phone = $_POST['phone'];
    $staff_address = $_POST['address'];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($staff_password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO staff (username, name, password, age, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssisss", $staff_username, $staff_name, $hashedPassword, $staff_age, $staff_email, $staff_phone, $staff_address);
        if ($stmt->execute()) {
            header("Location: staff.php?message=submitted");
        } else {
            header("Location: staff.php?message=err");
        }
        $stmt->close();
    } else {
        header("Location: staff.php?message=err");
    }

    $conn->close();
}
?>
