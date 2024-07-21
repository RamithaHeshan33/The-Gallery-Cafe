<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $food_id = $_POST['food_id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $category1 = $_POST['category1'];

    $sql = "UPDATE food SET name = ?, category = ?, price = ?, category1 = ? WHERE food_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdss', $name, $category, $price, $category1, $food_id);

    if ($stmt->execute()) {
        header("Location: menu.php?message=update");
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update food item.']);
    }
}
?>
