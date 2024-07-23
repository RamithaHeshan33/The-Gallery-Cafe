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
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/reservation.css">
    <link rel="stylesheet" href="../admin/css/menu.css">
    <link rel="stylesheet" href="../css/menu.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="body">
    <div class="hide">
        <video autoplay muted loop id="bgVideo">
            <source src="/img/order.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="menu">
            <div class="order">
                <?php if ($message == 'payment'): ?>
                    <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i> Your payment is successful.</div>
                <?php endif; ?>
                <h3>
                    Healthy Fresh <br> And Delicious <br> Food for You
                </h3>
            </div>
        </div>
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
                <select id="filterCuisine" onchange="filterFood()">
                    <option value="">All</option>
                    <option value="Sri Lankan">Sri Lankan</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Chinese">Chinese</option>
                </select>
                <label for="filterCategory">Filter by Category:</label>
                <select id="filterCategory" onchange="filterFood()">
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
        function filterFood() {
            const cuisine = document.getElementById('filterCuisine').value.toLowerCase();
            const category = document.getElementById('filterCategory').value.toLowerCase();
            const cards = document.querySelectorAll('.card');
            
            cards.forEach(card => {
                const cardCuisine = card.getAttribute('data-cuisine').toLowerCase();
                const cardCategory = card.getAttribute('data-category').toLowerCase();
                
                if ((cuisine === "" || cardCuisine === cuisine) && (category === "" || cardCategory === category)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        setTimeout(function() {
            const alertMessage = document.getElementById('alertMessage');
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
        }, 10000);
    </script>
</body>
</html>
