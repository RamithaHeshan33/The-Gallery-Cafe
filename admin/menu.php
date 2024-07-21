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

    // Function to filter foods by category
    function filter_food_by_category($foods, $category) {
        return array_filter($foods, function($food) use ($category) {
            return $food['category1'] === $category;
        });
    }

    $message = isset($_GET['message']) ? $_GET['message'] : '';

    $starters = filter_food_by_category($foods, 'Starters');
    $main_courses = filter_food_by_category($foods, 'Main Courses');
    $salads = filter_food_by_category($foods, 'Salads');
    $desserts = filter_food_by_category($foods, 'Desserts');
    $beverages = filter_food_by_category($foods, 'Beverage');

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
            <h1 class="food-title">Starters</h1>
            <div class="card-list">
                <?php if (!empty($starters)): ?>
                    <?php foreach ($starters as $food): ?>
                        <div class="card">
                            <input type="hidden" class="food-id" value="<?= htmlspecialchars($food['food_id']) ?>">
                            <div class="card-header">
                                <p class="food-name"><?= htmlspecialchars($food['name']) ?></p>
                            </div>
                            <div class="card-body">
                                <img src="data:image/jpeg;base64,<?= base64_encode_image($food['img']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" class="food-img">
                                <p><span class="label">Category:</span> <span class="food-category"><?= htmlspecialchars($food['category']) ?></span></p>
                                <p><span class="label">Price:</span> <span class="food-price"><?= htmlspecialchars($food['price']) ?></span> LKR</p>
                                <div class="btns">
                                    <input type="button" value="Update" class="btn2">
                                    <input type="button" value="Delete" class="btn3">
                                </div>
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
                                <div class="btns">
                                    <input type="submit" value="Update" class="btn2">
                                    <input type="button" value="Delete" class="btn3">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No main courses found.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="food-list-container">
            <h1 class="food-title">Salads</h1>
            <div class="card-list">
                <?php if (!empty($salads)): ?>
                    <?php foreach ($salads as $food): ?>
                        <div class="card">
                            <div class="card-header">
                                <p><?= htmlspecialchars($food['name']) ?></p>
                            </div>
                            <div class="card-body">
                                <img src="data:image/jpeg;base64,<?= base64_encode_image($food['img']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" class="food-img">
                                <p><span class="label">Category:</span> <?= htmlspecialchars($food['category']) ?></p>
                                <p><span class="label">Price:</span> <?= htmlspecialchars($food['price']) ?> LKR</p>
                                <div class="btns">
                                    <input type="submit" value="Update" class="btn2">
                                    <input type="button" value="Delete" class="btn3">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No salads found.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="food-list-container">
            <h1 class="food-title">Desserts</h1>
            <div class="card-list">
                <?php if (!empty($desserts)): ?>
                    <?php foreach ($desserts as $food): ?>
                        <div class="card">
                            <div class="card-header">
                                <p><?= htmlspecialchars($food['name']) ?></p>
                            </div>
                            <div class="card-body">
                                <img src="data:image/jpeg;base64,<?= base64_encode_image($food['img']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" class="food-img">
                                <p><span class="label">Category:</span> <?= htmlspecialchars($food['category']) ?></p>
                                <p><span class="label">Price:</span> <?= htmlspecialchars($food['price']) ?> LKR</p>
                                <div class="btns">
                                    <input type="submit" value="Update" class="btn2">
                                    <input type="button" value="Delete" class="btn3">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No desserts found.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="food-list-container">
            <h1 class="food-title">Beverage</h1>
            <div class="card-list">
                <?php if (!empty($beverages)): ?>
                    <?php foreach ($beverages as $food): ?>
                        <div class="card">
                            <div class="card-header">
                                <p><?= htmlspecialchars($food['name']) ?></p>
                            </div>
                            <div class="card-body">
                                <img src="data:image/jpeg;base64,<?= base64_encode_image($food['img']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" class="food-img">
                                <p><span class="label">Category:</span> <?= htmlspecialchars($food['category']) ?></p>
                                <p><span class="label">Price:</span> <?= htmlspecialchars($food['price']) ?> LKR</p>
                                <div class="btns">
                                    <input type="submit" value="Update" class="btn2">
                                    <input type="button" value="Delete" class="btn3">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No beverages found.</p>
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this food item?</p>
        <form id="deleteForm" action="delete_food.php" method="POST">
            <input type="hidden" id="delete_food_id" name="food_id">
            <button type="submit" class="batch btn3">Delete</button>
            <button type="button" class="batch btn1" id="cancelDelete">Cancel</button>
        </form>
    </div>
</div>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the modals
        var updateModal = document.getElementById("updateModal");
        var deleteModal = document.getElementById("deleteModal");

        // Get the <span> elements that close the modals
        var updateClose = updateModal.querySelector(".close");
        var deleteClose = deleteModal.querySelector(".close");

        // Get the cancel button for the delete modal
        var cancelDelete = document.getElementById("cancelDelete");

        // Function to open the update modal
        function openUpdateModal(event) {
            var card = event.target.closest(".card");
            if (!card) return; // Ensure a card is found

            var foodId = card.querySelector(".food-id") ? card.querySelector(".food-id").value : '';
            var name = card.querySelector(".food-name") ? card.querySelector(".food-name").innerText : '';
            var category = card.querySelector(".food-category") ? card.querySelector(".food-category").innerText : '';
            var price = card.querySelector(".food-price") ? card.querySelector(".food-price").innerText : '';

            // Debugging logs
            console.log("Food ID:", foodId);
            console.log("Name:", name);
            console.log("Category:", category);
            console.log("Price:", price);

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

            var foodId = card.querySelector(".food-id") ? card.querySelector(".food-id").value : '';

            // Populate the form with the data
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

        // When the user clicks cancel on delete modal
        cancelDelete.onclick = function() {
            deleteModal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == updateModal) {
                updateModal.style.display = "none";
            }
            if (event.target == deleteModal) {
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
    });
</script>



</html>
