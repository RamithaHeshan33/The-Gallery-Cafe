<?php
    session_start();
    require '../connection.php'; // Include your database connection file
    require 'admin-nav.php';

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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/reservation.css">
    <link rel="stylesheet" href="css/menu.css">
</head>
<body class="body">
    <video autoplay muted loop id="bgVideo">
        <source src="/img/staff1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="menu">
        <div class="message-container">
            <?php if ($message == 'submitted'): ?>
                <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i>Food card is Successfully created.</div>
            <?php elseif ($message == 'err'): ?>
                <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i>Something went wrong.</div>
            <?php elseif ($message == 'update'): ?>
                <div class="alert alert-success" id="alertMessage"><i class="fas fa-times-circle"></i>Food card is updated successfully.</div>
            <?php elseif ($message == 'delete'): ?>
                <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i>Food card is deleted successfully.</div>
            <?php endif; ?>
        </div>
        <div class="para">
            <form action="save_food.php" method="POST" enctype="multipart/form-data">
                <div class="form-container">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="food_id">Food ID:</label>
                            <input type="text" id="food_id" name="food_id" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Food Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="category">Cuisine Type:</label>
                            <select id="category" name="category" required>
                                <option value="">Select Cuisine Type</option>
                                <option value="Sri Lankan">Sri Lankan</option>
                                <option value="Japanese">Japanese</option>
                                <option value="Chinese">Chinese</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" id="price" name="price" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="img">Image:</label>
                            <input type="file" id="img" name="img" required>
                        </div>
                        <div class="form-group">
                            <label for="cato">Category:</label>
                            <select id="cato" name="category1" required>
                                <option value="">Select Category</option>
                                <option value="Starters">Starters</option>
                                <option value="Main Courses">Main Courses</option>
                                <option value="Salads">Salads</option>
                                <option value="Desserts">Desserts</option>
                                <option value="Beverage">Beverage</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="batch view-link">Add a food card</button>
            </form>
        </div>
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
                                    <input type="button" value="Update" class="btn2">
                                    <input type="button" value="Delete" class="btn3">
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

    <!-- Update Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Update Food Item</h2>
            <form id="updateForm" action="update_food.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="update_food_id" name="food_id">
                <div class="form-group">
                    <label for="update_name">Food Name:</label>
                    <input type="text" id="update_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="update_category">Cuisine Type:</label>
                    <select id="update_category" name="category" required>
                        <option value="Sri Lankan">Sri Lankan</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Chinese">Chinese</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="update_price">Price:</label>
                    <input type="text" id="update_price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="update_img">Image:</label>
                    <input type="file" id="update_img" name="img">
                </div>
                <div class="form-group">
                    <label for="update_cato">Category:</label>
                    <select id="update_cato" name="category1" required>
                        <option value="Starters">Starters</option>
                        <option value="Main Courses">Main Courses</option>
                        <option value="Salads">Salads</option>
                        <option value="Desserts">Desserts</option>
                        <option value="Beverage">Beverage</option>
                    </select>
                </div>
                <button type="submit" class="batch view-link">Update</button>
            </form>
        </div>
    </div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Are you sure you want to delete this food item?</h2>
        <form id="deleteForm" action="delete_food.php" method="POST">
            <input type="hidden" id="delete_food_id" name="food">
            <div class="btns">
                <button type="submit" class="btn2">Delete</button>
                <button type="button" class="btn3 cancel">Cancel</button>
            </div>
            
        </form>
    </div>
</div>

</body>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the modals
    var updateModal = document.getElementById("updateModal");
    var deleteModal = document.getElementById("deleteModal");

    // Get the <span> element that closes the modal
    var updateClose = updateModal.querySelector(".close");
    var deleteClose = deleteModal.querySelector(".close");

    // Function to open the update modal
    function openUpdateModal(event) {
        var card = event.target.closest(".card");
        if (!card) return; // Ensure a card is found

        var foodId = card.querySelector(".food-id").value;
        var name = card.querySelector(".food-name").innerText;
        var category = card.querySelector(".food-category").innerText;
        var price = card.querySelector(".food-price").innerText;

        // Populate the form with the data
        document.getElementById("update_food_id").value = foodId;
        document.getElementById("update_name").value = name;
        document.getElementById("update_category").value = category;
        document.getElementById("update_price").value = price;

        // Show the modal
        updateModal.style.display = "block";
    }

    // Function to open the delete modal
    function openDeleteModal(event) {
        var card = event.target.closest(".card");
        if (!card) return; // Ensure a card is found

        var foodId = card.querySelector(".food-id").value;

        // Populate the form with the food ID
        document.getElementById("delete_food_id").value = foodId;

        // Show the modal
        deleteModal.style.display = "block";
    }

    // Use event delegation to handle clicks on buttons
    document.body.addEventListener("click", function(event) {
        if (event.target.classList.contains("btn2")) {
            openUpdateModal(event);
        } else if (event.target.classList.contains("btn3")) {
            openDeleteModal(event);
        }
    });

    // When the user clicks on <span> (x), close the modal
    updateClose.onclick = function() {
        updateModal.style.display = "none";
    };

    deleteClose.onclick = function() {
        deleteModal.style.display = "none";
    };

    // When the user clicks on Cancel button, close the delete modal
    document.querySelector(".cancel").onclick = function() {
        deleteModal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == updateModal) {
            updateModal.style.display = "none";
        } else if (event.target == deleteModal) {
            deleteModal.style.display = "none";
        }
    };

    // Hide alert message after 10 seconds
    setTimeout(function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 10000);

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
});
</script>

</html>
