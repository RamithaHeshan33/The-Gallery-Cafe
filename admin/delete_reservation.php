<?php
// Start the session
session_start();

// Include the database connection
include_once('../connection.php');

// Check if all required fields are set
if (isset($_POST['slot_number'], $_POST['reserve_date'], $_POST['reserve_time'], $_POST['username'], $_POST['phone'])) {
    $slot_number = $_POST['slot_number'];
    $reserve_date = $_POST['reserve_date'];
    $reserve_time = $_POST['reserve_time'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    
    // Prepare the SQL delete statement
    $sql = "DELETE FROM parking_reservation WHERE slot_number = ? AND reserve_date = ? AND reserve_time = ? AND username = ? AND phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issss', $slot_number, $reserve_date, $reserve_time, $username, $phone);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the reservation management page
        header("Location: park-reservation.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Required fields not provided";
}

$conn->close();
?>
