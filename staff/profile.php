<?php
session_start();
require 'staff-nav.php';

// Database connection
require '../connection.php';

$username = $_SESSION['username'];

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
    <link rel="stylesheet" href="../admin/css/menu.css">
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
            </div>
        </div>
        <br><br>
    </div>
</div>

</body>
</html>
