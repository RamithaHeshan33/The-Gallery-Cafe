<?php
session_start();

include_once('connection.php');

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    $sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Order deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete the order.";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid request.";
}

$conn->close();

header("Location: orderdetails.php");
exit();
?>
