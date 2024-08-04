<?php
// Include the necessary files and start session
session_start();
require '../connection.php';

// Check if the 'id' is set in the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Get the event ID from the POST request
    $eventId = $_POST['id'];

    // SQL query to delete the event
    $sql = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventId);

    // Execute the query and check for errors
    if ($stmt->execute()) {
        // If successful, redirect to the event management page with a success message
        header("Location: events.php?message=delete");
    } else {
        // If there was an error, redirect with an error message
        header("Location: events.php?message=err");
    }

}
?>
