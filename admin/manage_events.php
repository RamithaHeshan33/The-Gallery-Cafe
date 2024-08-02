<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Handle file upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $img = file_get_contents($_FILES['img']['tmp_name']);
    } else {
        $img = null; // Default to null if no file is uploaded
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO events (title, description, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $title, $description, $img);

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: events.php?message=submitted");
    } else {
        // Redirect with error message
        header("Location: events.php?message=err");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect if accessed directly
    header("Location: events.php");
}
?>
