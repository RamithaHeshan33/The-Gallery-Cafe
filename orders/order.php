<?php
session_start();

require '../parking/nav1.php';
require '../connection.php';

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
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="../css/menu.css">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        };
        setTimeout("preventBack()", 0);
        window.onunload = function() {null;}

    </script> -->
</head>
<body class="body">
    <div class="home">
        <div class="para">
        <?php if ($message == 'payment'): ?>
            <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i> Your payment is successful.</div>
        <?php endif; ?>
            <h1 class="items-justify">
                It's not just <br> Food, it's an <br> Experience
            </h1>
            <div class="btn items-center space-x-4 mt-4">
            </div>
        </div>
        <img class="home-pic" src="../img/file (1).png" alt="">
    </div>

    <div class="items">
        <div class="food-list-container">
            <?php if ($message == 'submitted'): ?>
                <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i> Your item has been added to the cart.</div>
            <?php elseif ($message == 'err'): ?>
                <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i> Something went wrong.</div>
            <?php elseif ($message == 'quantity'): ?>
                <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i> Add another one to the cart.</div>
            <?php endif; ?>
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
            <a href="cart.php"><input type="button" value="View Cart" class="btn1"></a>

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
                                <p><span class="label">Category:</span> <?= htmlspecialchars($food['category']) ?></p>
                                <p><span class="label">Price:</span> <?= htmlspecialchars($food['price']) ?> LKR</p>
                                <div class="btns">
                                <form method="post" action="add_to_cart.php">
                                    <input type="hidden" name="food_id" value="<?= htmlspecialchars($food['food_id']) ?>">
                                    <input type="hidden" name="food_name" value="<?= htmlspecialchars($food['name']) ?>">
                                    <input type="hidden" name="food_price" value="<?= htmlspecialchars($food['price']) ?>">
                                    <input type="submit" value="Add" class="btn2">
                                    <input type="button" value="Rate" class="btn2">
                                </form>
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

    <script>
        setTimeout(function() {
            var alertMessage = document.getElementById('alertMessage');
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
        }, 10000);
    </script>
</body>
</html>
