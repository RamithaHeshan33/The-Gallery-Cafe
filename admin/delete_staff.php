<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_id = $_POST['staff_id'];

    $sql = "DELETE FROM staff WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $staff_id);

    if ($stmt->execute()) {
        header("Location: staff.php?message=delete");
    } else {
        header("Location: staff.php?message=err");
    }

    $stmt->close();
    $conn->close();
}
?>
