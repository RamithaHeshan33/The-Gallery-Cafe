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

    // Start transaction
    $conn->begin_transaction();

    try {
        // Prepare the SQL delete statement
        $sql = "DELETE FROM parking_reservation WHERE slot_number = ? AND reserve_date = ? AND reserve_time = ? AND username = ? AND phone = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issss', $slot_number, $reserve_date, $reserve_time, $username, $phone);

        // Execute the delete statement
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }
        $stmt->close();

        // Prepare the SQL update statement
        $update = "UPDATE slot_available SET availability = 'Available' WHERE slot_number = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param('i', $slot_number);

        // Execute the update statement
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Commit the transaction
        $conn->commit();

        // Redirect back to the reservation management page
        header("Location: park-reservation.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $stmt->close();
} else {
    echo "Required fields not provided";
}

$conn->close();
?>
