<?php
session_start();

include_once('../connection.php');

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $userId = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        header("Location: user_profiles.php");
        exit();
    }
    else {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

}

?>
