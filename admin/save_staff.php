<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO staff (username, name, password, age, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssisss", $username, $name, $hashedPassword, $age, $email, $phone, $address);
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
