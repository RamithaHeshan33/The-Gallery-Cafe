<?php
require __DIR__ . '/vendor/autoload.php';
include_once('../connection.php');

if (isset($_GET['username']) && isset($_GET['amount'])) {
    $username = htmlspecialchars($_GET['username'], ENT_QUOTES, 'UTF-8');
    $amount = htmlspecialchars($_GET['amount'], ENT_QUOTES, 'UTF-8');

    // Delete the items from the cart for the relevant username
    $sql = "DELETE FROM cart WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    // Check if the items were deleted
    if ($stmt->affected_rows > 0) {
        header("Location: order.php?message=payment");
        exit();
    }

    else {
        header("Location: order.php?message=err");
        exit();
    }
}
?>
