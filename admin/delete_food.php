<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $food_id = $_POST['food_id'];

    $sql = "DELETE FROM food WHERE food_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $food_id);

    if ($stmt->execute()) {
        header('Location: menu.php?message=delete');
    } else {
        header('Location: menu.php?message=err');
    }
}
?>
