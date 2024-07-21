<?php
    session_start();

    require 'admin-nav.php';
    require '../connection.php';

    // SQL query to fetch food items
    $sql = "SELECT * FROM food";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="css/menu.css">

</head>
<body>
<div class="res-container">
    <div class="table-container-2">
        <h1>Shopping Cart</h1>
        <div class="table">
            <table>
                <tr>
                    <th>Food ID</th>
                    <th>Food Name</th>
                    <th>Cuisine Type</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                <?php
                $grandTotal = 0; // Initialize grand total
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-cell='Food ID'>" . htmlspecialchars($row['food_id'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Food Name'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Cuisine Type'>" . htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Price'>" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Image'><img src='data:image/jpeg;base64," . base64_encode($row['img']) . "' alt='" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "' width='50' height='50'/></td>";
                        echo "<td data-cell='Category'>" . htmlspecialchars($row['category1'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Actions'>
                                <form method='post' action='update_quantity.php' style='display:inline-block;'>
                                    <input type='hidden' name='food_id' value='" . $row['food_id'] . "'>
                                    <input type='submit' value='Update' class='btn2'>
                                </form>
                                <form method='post' action='delete_item.php' style='display:inline-block;'>
                                    <input type='hidden' name='food_id' value='" . $row['food_id'] . "'>
                                    <input type='submit' value='Delete' class='btn3'>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No items in cart</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Item</h2>
        <form id="updateForm" method="post" action="update_quantity.php">
            <input type="hidden" name="food_id" id="modalFoodId">
            <label for="modalFoodName">Food Name:</label>
            <input type="text" id="modalFoodName" name="food_name" required><br>
            <label for="modalQuantity">Quantity:</label>
            <input type="number" id="modalQuantity" name="quantity" required min="1"><br>
            <input type="submit" value="Update" class="btn2">
        </form>
    </div>
</div>

</body>

<script>
    // Get the modal
var modal = document.getElementById("updateModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get all update buttons
var updateButtons = document.querySelectorAll(".btn2");

// When the user clicks on a button, open the modal and populate it with data
updateButtons.forEach(function(button) {
    button.onclick = function(event) {
        event.preventDefault();
        var form = this.closest('form');
        var foodId = form.querySelector("input[name='food_id']").value;
        var foodName = form.querySelector("input[name='food_name']").value; // Adjust if not present
        var quantity = form.querySelector("input[name='quantity']").value; // Adjust if not present

        // Populate modal fields
        document.getElementById("modalFoodId").value = foodId;
        document.getElementById("modalFoodName").value = foodName;
        document.getElementById("modalQuantity").value = quantity;

        // Display the modal
        modal.style.display = "block";
    };
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
</html>
