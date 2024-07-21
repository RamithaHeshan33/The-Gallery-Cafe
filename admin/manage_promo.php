<?php
require '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = file_get_contents($_FILES['img']['tmp_name']);

    $sql = "INSERT INTO promo (title, description, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssb", $title, $description, $null);

    // Send the BLOB data
    $stmt->send_long_data(2, $image);

    if ($stmt->execute()) {
        header("Location: promo.php?message=submitted");
    } else {
        header("Location: promo.php?message=err");
    }
}
?>
