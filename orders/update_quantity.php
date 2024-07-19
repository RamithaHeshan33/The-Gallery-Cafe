<?php
session_start();

// Include the database connection
include_once('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the cart
    $sql = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $quantity, $item_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

// Redirect back to the cart page
header("Location: cart.php");
exit();
?>
