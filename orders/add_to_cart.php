<?php
session_start();
require '../connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $food_id = $_POST['food_id'];
        $food_name = $_POST['food_name'];
        $food_price = $_POST['food_price'];
        $username = $_SESSION['username']; // Assuming username is stored in session

        // Check if the item is already in the cart
        $check_sql = "SELECT * FROM cart WHERE username = ? AND name = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param('ss', $username, $food_name);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // If item is already in the cart, update the quantity
            $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE username = ? AND name = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param('ss', $username, $food_name);
            $update_stmt->execute();
            $update_stmt->close();

            $update_sql1 = "UPDATE orders SET quantity = quantity + 1 WHERE username = ? AND name = ?";
            $update_stmt1 = $conn->prepare($update_sql1);
            $update_stmt1->bind_param('ss', $username, $food_name);
            if ($update_stmt1->execute()) {
                header("Location: order.php?message=quantity");
            } else {
                header("Location: order.php?message=err");
            }
            $update_stmt1->close();
        } else {
            // If item is not in the cart, insert new row
            $insert_sql = "INSERT INTO cart (username, name, price, quantity) VALUES (?, ?, ?, 1)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param('ssd', $username, $food_name, $food_price);

            $insert_sql1 = "INSERT INTO orders (username, name, price, quantity) VALUES (?, ?, ?, 1)";
            $insert_stmt1 = $conn->prepare($insert_sql1);
            $insert_stmt1->bind_param('ssd', $username, $food_name, $food_price);
            if ($insert_stmt->execute() && $insert_stmt1->execute()) {
                header("Location: order.php?message=submitted");
            } else {
                header("Location: order.php?message=err");
            }
            $insert_stmt->close();
            $insert_stmt1->close();
        }

        $check_stmt->close();
        $conn->close();
        exit();
    }
} catch (Exception $e) {
    header("Location: order.php?message=exception&error=" . $e->getMessage());
    exit();
}
?>
