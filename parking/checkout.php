<?php
require '../connection.php';

// Insert reservation details into database
$username = $_GET['username'];
$phone = $_GET['phone'];
$slot_number = $_GET['slotNumber'];
$vehicle_number = $_GET['vehicleNumber'];
$reserve_date = $_GET['reserveDate'];
$reserve_time = $_GET['reserveTime'];
$exit_date = $_GET['exitDate'];
$exit_time = $_GET['exitTime'];

$sql = "INSERT INTO parking_reservation (slot_number, vehicle_number, reserve_date, reserve_time, exit_date, exit_time, username, phone) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error preparing statement: ' . $conn->error);
}

$stmt->bind_param("isssssss", $slot_number, $vehicle_number, $reserve_date, $reserve_time, $exit_date, $exit_time, $username, $phone);

if ($stmt->execute()) {
    header("Location: parking.php?message=reserved");
    exit();
} else {
    echo "Error executing statement: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
