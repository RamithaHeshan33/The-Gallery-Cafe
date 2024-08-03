<?php
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $food_id = $_POST['food_id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $category1 = $_POST['category1'];
    $img = null;

    // Check if a new image has been uploaded
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $img = file_get_contents($_FILES['img']['tmp_name']);
    }

    // Prepare SQL query with or without image update
    if ($img) {
        $sql = "UPDATE food SET name = ?, category = ?, price = ?, img = ?, category1 = ? WHERE food_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssdsss', $name, $category, $price, $img, $category1, $food_id);
    } else {
        $sql = "UPDATE food SET name = ?, category = ?, price = ?, category1 = ? WHERE food_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssdss', $name, $category, $price, $category1, $food_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        header("Location: menu.php?message=update");
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update food item.']);
    }
}
?>
