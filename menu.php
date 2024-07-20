<?php
    session_start();
    require 'connection.php'; // Include your database connection file
    require 'nav1.php';
    // SQL query to fetch food items
    $sql = "SELECT name, category, price, img, cat FROM food";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set from the prepared statement

    $foods = []; // Initialize an empty array to store fetched data

    while ($food = $result->fetch_assoc()) {
        $foods[] = $food; // Append each row to $foods array
    }

    // Function to convert BLOB to base64
    function base64_encode_image($img) {
        return base64_encode($img);
    }

    // Function to filter foods by category
    function filter_food_by_category($foods, $category) {
        return array_filter($foods, function($food) use ($category) {
            return $food['cat'] === $category;
        });
    }

    $starters = filter_food_by_category($foods, 'Starters');
    $main_courses = filter_food_by_category($foods, 'Main Courses');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>
</head>
<body class="body">
    <div class="menu">
        <div class="para">
            <h1 class="items-justify">
                It's not just <br> Food, it's an <br> Experience
            </h1>
            <div class="btn items-center space-x-4 mt-4">
                <a href="orders/order.php"><button class="orderBtn">Order</button></a>
            </div>
        </div>
        <img class="home-pic" src="img/file (1).png" alt="">
    </div>

    <div class="items">
        <div class="food-list-container">
            <h1 class="food-title">Starters</h1>
            <div class="card-list">
                <?php if (!empty($starters)): ?>
                    <?php foreach ($starters as $food): ?>
                        <div class="card">
                            <div class="card-header">
                                <p><?= htmlspecialchars($food['name']) ?></p>
                            </div>
                            <div class="card-body">
                                <img src="data:image/jpeg;base64,<?= base64_encode_image($food['img']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" class="food-img">
                                <p><span class="label">Category:</span> <?= htmlspecialchars($food['category']) ?></p>
                                <p><span class="label">Price:</span> <?= htmlspecialchars($food['price']) ?> LKR</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No starters found.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="food-list-container">
            <h1 class="food-title">Main Courses</h1>
            <div class="card-list">
                <?php if (!empty($main_courses)): ?>
                    <?php foreach ($main_courses as $food): ?>
                        <div class="card">
                            <div class="card-header">
                                <p><?= htmlspecialchars($food['name']) ?></p>
                            </div>
                            <div class="card-body">
                                <img src="data:image/jpeg;base64,<?= base64_encode_image($food['img']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" class="food-img">
                                <p><span class="label">Category:</span> <?= htmlspecialchars($food['category']) ?></p>
                                <p><span class="label">Price:</span> <?= htmlspecialchars($food['price']) ?> LKR</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No main courses found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
