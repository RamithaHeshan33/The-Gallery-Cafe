<?php
session_start();
require '../connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['food'])) {
        $food_id = $_POST['food'];

        $sql = "DELETE FROM food WHERE food_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $food_id); // Assuming food_id is a string, use "i" if it's an integer

        if ($stmt->execute()) {
            header('Location: menu.php?message=delete');
        } else {
            header('Location: menu.php?message=err');
        }

        $stmt->close();
    } else {
        header('Location: menu.php?message=err');
    }
}

$conn->close();
?>
