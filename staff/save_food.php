<?php
session_start();
require '../connection.php'; // Include your database connection file

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $food_id = $_POST['food_id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $cat = $_POST['category1']; // Updated field name

    // Handle the image upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $img = file_get_contents($_FILES['img']['tmp_name']);
    } else {
        $img = null; // Handle the case where no image is uploaded
    }

    // Insert the new food item into the database
    $sql = "INSERT INTO food (food_id, name, category, price, img, category1) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($img !== null) {
        $stmt->bind_param("ssssbs", $food_id, $name, $category, $price, $img, $cat);
        $stmt->send_long_data(4, $img);
    } else {
        $stmt->bind_param("ssssss", $food_id, $name, $category, $price, $img, $cat);
    }

    if ($stmt->execute()) {
        $message = 'submitted';
    } else {
        $message = 'err';
    }

    // Redirect back to the original page with a message
    header("Location: menu.php?message=$message");
    exit();
}
?>
