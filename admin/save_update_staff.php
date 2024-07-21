<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_id = $_POST['staff_id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (!empty($password)) {
        // Hash the new password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE staff SET username = ?, name = ?, password = ?, age = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisssi", $username, $name, $hashedPassword, $age, $email, $phone, $address, $staff_id);
    } else {
        $sql = "UPDATE staff SET username = ?, name = ?, age = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisssi", $username, $name, $age, $email, $phone, $address, $staff_id);
    }

    if ($stmt->execute()) {
        header("Location: staff.php?message=update");
    } else {
        header("Location: staff.php?message=err");
    }

    $stmt->close();
    $conn->close();
}
?>
