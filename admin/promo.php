<?php
    require 'admin-nav.php';
    require '../connection.php';

    // SQL query to fetch food items
    $sql = "SELECT * FROM promo";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set from the prepared statement

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

    <link rel="stylesheet" href="css/promo.css">
    <link rel="stylesheet" href="css/menu.css">
    <!-- <link rel="stylesheet" href="../css/reservation.css"> -->
</head>
<body>
<div class="menu">
    <div class="message-container">
        <?php if ($message == 'submitted'): ?>
            <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i>Promotion card is Successfully created.</div>
        <?php elseif ($message == 'err'): ?>
            <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i>Something went wrong.</div>
        <?php elseif ($message == 'update'): ?>
            <div class="alert alert-success" id="alertMessage"><i class="fas fa-times-circle"></i>Promotion card is updated successfully.</div>
        <?php elseif ($message == 'delete'): ?>
            <div class="alert alert-danger" id="alertMessage"><i class="fas fa-times-circle"></i>Promotion card is deleted successfully.</div>
        <?php endif; ?>
    </div>
    <div class="para">
        <form action="manage_promo.php" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Promotion Title:</label>
                        <input type="text" id="title" name="title" placeholder="Offer Title" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="5" placeholder="Offer Description" required></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="img">Image:</label>
                        <input type="file" id="img" name="img" required>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="batch view-link">Add a food card</button>
        </form>
    </div>
</div>

<div class="title">
    <h1>Offer List</h1>
</div>


<div class="promo-list">
    <?php if ($result->num_rows > 0): ?>
        <?php while($promo = $result->fetch_assoc()): ?>
    <div class="promo-item">
        <div class="promo-img">
            <?php if (!empty($promo['image'])): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($promo['image']) ?>" alt="<?= htmlspecialchars($promo['title']) ?>" class="home-pic">
            <?php else: ?>
                <img src="img/s.jpg" alt="Default Promotion Image" class="home-pic">
            <?php endif; ?>
        </div>
        <div class="promo-content">
            <h1><?= htmlspecialchars($promo['title']) ?></h1>
            <p><?= htmlspecialchars($promo['description']) ?></p>
            <div class="btns">
                <input type="button" value="Update" class="btn2" data-id="<?= $promo['id'] ?>" data-title="<?= htmlspecialchars($promo['title']) ?>" data-description="<?= htmlspecialchars($promo['description']) ?>">
                <input type="button" value="Delete" class="btn3" data-id="<?= $promo['id'] ?>">
            </div>
        </div>
    </div>
<?php endwhile; ?>

    <?php else: ?>
        <div class="promo-item">
            <div class="promo-img">
                <img src="img/service3.jpg" alt="No Offers Available" class="home-pic">
            </div>
            <div class="promo-content">
                <h1>No offer available</h1>
                <p>Currently, there are no promotions available.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Update Modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeUpdateModal">&times;</span>
        <form id="updateForm" action="update_promo.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="updateId" name="id">
            <div class="form-group">
                <label for="updateTitle">Promotion Title:</label>
                <input type="text" id="updateTitle" name="title" required>
            </div>
            <div class="form-group">
                <label for="updateDescription">Description:</label>
                <textarea id="updateDescription" name="description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="updateImg">Image:</label>
                <input type="file" id="updateImg" name="img">
            </div>
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeDeleteModal">&times;</span>
        <p>Are you sure you want to delete this promotion?</p>
        <form id="deleteForm" action="delete_promo.php" method="POST">
            <input type="hidden" id="deleteId" name="id">
            <div class="btns">
            <button type="submit" class="btn2">Delete</button>
            <button type="button" class="btn3 cancel" id="cancelDelete">Cancel</button>
            </div>
            
        </form>
    </div>
</div>

</div>
</body>
<script>
    // Get the modals
    var updateModal = document.getElementById("updateModal");
    var deleteModal = document.getElementById("deleteModal");

    // Get the buttons that open the modals
    var updateBtns = document.querySelectorAll(".btn2");
    var deleteBtns = document.querySelectorAll(".btn3");

    // Get the <span> elements that close the modals
    var spanUpdate = document.getElementById("closeUpdateModal");
    var spanDelete = document.getElementById("closeDeleteModal");
    var cancelDeleteBtn = document.getElementById("cancelDelete");

    // When the user clicks on a button, open the respective modal 
    updateBtns.forEach(btn => {
        btn.onclick = function() {
            var id = this.getAttribute("data-id");
            var title = this.getAttribute("data-title");
            var description = this.getAttribute("data-description");

            document.getElementById("updateId").value = id;
            document.getElementById("updateTitle").value = title;
            document.getElementById("updateDescription").value = description;

            updateModal.style.display = "block";
        }
    });

    deleteBtns.forEach(btn => {
        btn.onclick = function() {
            var id = this.getAttribute("data-id");
            document.getElementById("deleteId").value = id;

            deleteModal.style.display = "block";
        }
    });

    // When the user clicks on <span> (x), close the modal
    spanUpdate.onclick = function() {
        updateModal.style.display = "none";
    }

    spanDelete.onclick = function() {
        deleteModal.style.display = "none";
    }

    // When the user clicks on the cancel button, close the delete modal
    cancelDeleteBtn.onclick = function() {
        deleteModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == updateModal) {
            updateModal.style.display = "none";
        }
        if (event.target == deleteModal) {
            deleteModal.style.display = "none";
        }
    }

    setTimeout(function() {
            var alertMessage = document.getElementById('alertMessage');
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
    }, 10000);
</script>


</html>
