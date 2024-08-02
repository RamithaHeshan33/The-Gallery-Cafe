<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Handle file upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $img = file_get_contents($_FILES['img']['tmp_name']);
        $imgQueryPart = ", image = ?";
    } else {
        $imgQueryPart = ""; // No image update
    }

    // Prepare and execute the SQL query
    $sql = "UPDATE events SET title = ?, description = ?" . $imgQueryPart . " WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($imgQueryPart) {
        $stmt->bind_param('sssi', $title, $description, $img, $id);
    } else {
        $stmt->bind_param('ssi', $title, $description, $id);
    }

    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: events.php?message=update");
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
