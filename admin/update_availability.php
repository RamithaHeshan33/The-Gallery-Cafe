<?php
include_once('../connection.php');

if (isset($_POST['slot_number'], $_POST['availability'])) {
    $slot_number = $_POST['slot_number'];
    $availability = $_POST['availability'];

    $sql = "UPDATE slot_available SET availability = ? WHERE slot_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $availability, $slot_number);

    if ($stmt->execute()) {
        echo "Availability updated successfully.";
    } else {
        echo "Error updating availability: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
