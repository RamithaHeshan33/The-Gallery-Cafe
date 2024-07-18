<?php
    require 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $booking_date = $_POST['booking_date'];
        $booking_time = $_POST['booking_time'];
        $adults = $_POST['adults'];
        $kids = $_POST['kids'];

        // Generate a unique reservation ID
        $res_number = 'TABLE-RES-' . uniqid();

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO table_reservation (username, name, email, phone, `book-date`, `book-time`, adults, kids, res_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssis",$username, $name, $email, $phone, $booking_date, $booking_time, $adults, $kids, $res_number);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: reservation.php?message=submitted&res_number=$res_number");
            exit();
        } else {
            header("Location: reservation.php?message=err");
            exit();
        }
    }
?>
