<?php
    session_start();
    require 'connection.php'; // Include your database connection file
    require 'nav1.php';
    
    // SQL query to fetch food items
    $sql = "SELECT food_id, name, category, price, img, category1 FROM food";
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

    $message = isset($_GET['message']) ? $_GET['message'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>

    <link rel="stylesheet" href="css/menu.css">

    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        };
        setTimeout("preventBack()", 0);
        window.onunload = function() {null;}

    </script>
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
            <h1 class="food-title">All Food Items</h1>
            <div class="filter-bar">
                <label for="filterCuisine">Filter by Cuisine:</label>
                <select id="filterCuisine">
                    <option value="">All</option>
                    <option value="Sri Lankan">Sri Lankan</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Chinese">Chinese</option>
                </select>
                <label for="filterCategory">Filter by Category:</label>
                <select id="filterCategory">
                    <option value="">All</option>
                    <option value="Starters">Starters</option>
                    <option value="Main Courses">Main Courses</option>
                    <option value="Salads">Salads</option>
                    <option value="Desserts">Desserts</option>
                    <option value="Beverage">Beverage</option>
                </select>
            </div>
            <div class="card-list" id="foodCards">
                <?php if (!empty($foods)): ?>
                    <?php foreach ($foods as $food): ?>
                        <div class="card" data-cuisine="<?= htmlspecialchars($food['category']) ?>" data-category="<?= htmlspecialchars($food['category1']) ?>">
                            <input type="hidden" class="food-id" value="<?= htmlspecialchars($food['food_id']) ?>">
                            <div class="card-header">
                                <p class="food-name"><?= htmlspecialchars($food['name']) ?></p>
                            </div>
                            <div class="card-body">
                                <img src="data:image/jpeg;base64,<?= base64_encode_image($food['img']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" class="food-img">
                                <p><span class="label">Cuisine:</span> <span class="food-category"><?= htmlspecialchars($food['category']) ?></span></p>
                                <p><span class="label">Price:</span> <span class="food-price"><?= htmlspecialchars($food['price']) ?></span> LKR</p>
                                <p><span class="label">Category:</span> <span class="food-price"><?= htmlspecialchars($food['category1']) ?></span></p>
                                <div class="btns">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="empty">No food items.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

<script>
    // Function to filter food items
    function filterFoods() {
        var filterCuisine = document.getElementById("filterCuisine").value;
        var filterCategory = document.getElementById("filterCategory").value;

        var foodCards = document.getElementsByClassName("card");

        for (var i = 0; i < foodCards.length; i++) {
            var card = foodCards[i];
            var cuisine = card.getAttribute("data-cuisine");
            var category = card.getAttribute("data-category");

            if ((filterCuisine === "" || filterCuisine === cuisine) &&
                (filterCategory === "" || filterCategory === category)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        }
    }

    // Add event listeners for the filter selects
    document.getElementById("filterCuisine").addEventListener("change", filterFoods);
    document.getElementById("filterCategory").addEventListener("change", filterFoods);
</script>
</html>
