<?php
require '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = isset($_FILES['img']['tmp_name']) && !empty($_FILES['img']['tmp_name']) ? file_get_contents($_FILES['img']['tmp_name']) : null;

    if ($image) {
        $sql = "UPDATE promo SET title = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssbi", $title, $description, $null, $id);
        $stmt->send_long_data(2, $image);
    } else {
        $sql = "UPDATE promo SET title = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $description, $id);
    }

    if ($stmt->execute()) {
        header("Location: promo.php?message=update");
    } else {
        header("Location: promo.php?message=err");
    }
}
?>
