<?php
session_start();
require 'staff-nav.php';

// Database connection
require '../connection.php';

$username = $_SESSION['username']; // Assuming the username is stored in session

$sql = "SELECT * FROM staff WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $age = $row['age'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    // Add other fields as needed
} else {
    echo "No results found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC INSTITUTE</title>
    <link rel="stylesheet" href="../style-template.css">
    <link rel="stylesheet" href="../style-view_profile.css">
</head>
<body>
<div class="container">
    <div class="side-container">
        <div class="profilepic">
            <label for="profile-image-input">
                <div id="profile-image-container">
                    <img id="profile-image-preview" src="../img/profile.png" alt="User Profile Icon">
                </div>
            </label>
            <input type="file" id="profile-image-input" accept="image/*" style="display:none;">
            <button id="change-profile-image-button" type="button">Change Image</button>
        </div>
    </div>

    <div class="profileTop">
        <b><h1 class="topname"> <span><?php echo isset($name) ? $name : ''; ?></span></h1></b>
        <br>
        <div class="p_data">
            <div class="personal_details">
                <h2> Personal Details</h2>
                <hr>
                <br>
                <div class="form-row">
                    <span class="form-label">Admin ID:</span>
                    <span class="form-value"><?php echo isset($username) ? $username : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">Name:</span>
                    <span class="form-value"><?php echo isset($name) ? $name : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">Age:</span>
                    <span class="form-value"><?php echo isset($age) ? $age : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">Email:</span>
                    <span class="form-value"><?php echo isset($email) ? $email : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">Phone:</span>
                    <span class="form-value"><?php echo isset($phone) ? $phone : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">Address:</span>
                    <span class="form-value"><?php echo isset($address) ? $address : ''; ?></span>
                </div>
                <!-- Add other fields as needed -->
            </div>
        </div>
        <br><br>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const profileImageInput = document.getElementById("profile-image-input");
    const profileImagePreview = document.getElementById("profile-image-preview");
    const changeProfileImageButton = document.getElementById("change-profile-image-button");

    changeProfileImageButton.addEventListener("click", function() {
        profileImageInput.click();
    });

    profileImageInput.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    const squareSize = Math.min(this.width, this.height);
                    canvas.width = squareSize;
                    canvas.height = squareSize;

                    const offsetX = (this.width - squareSize) / 2;
                    const offsetY = (this.height - squareSize) / 2;

                    ctx.drawImage(this, offsetX, offsetY, squareSize, squareSize, 0, 0, squareSize, squareSize);
                    profileImagePreview.src = canvas.toDataURL();
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
</body>
</html>