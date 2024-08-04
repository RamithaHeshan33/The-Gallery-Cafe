<?php
    session_start();
    require 'nav1.php';
    require 'connection.php';

    if (isset($_SESSION['username'])) {
        $username = mysqli_real_escape_string($conn, $_SESSION['username']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $nic = $row['nic'];
            $dob = $row['dob'];
        } else {
            header("Location: login.php");
            exit();
        }
    } else {
        header("Location: login.php");
        exit();
    }

    // handle form submission to update user data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_name = mysqli_real_escape_string($conn, $_POST['name']);
        $new_phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $new_dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $new_nic = mysqli_real_escape_string($conn, $_POST['nic']);
        $new_email = mysqli_real_escape_string($conn, $_POST['email']);

        $update_stmt = $conn->prepare("UPDATE users SET name = ?, phone = ?, dob = ?, nic = ?, email = ? WHERE username = ?");
        $update_stmt->bind_param("ssssss", $new_name, $new_phone, $new_dob, $new_nic, $new_email, $username);

        if ($update_stmt->execute()) {
            header("Location: profile.php?message=update");
            exit();
        }
    }

    $message = isset($_GET['message']) ? $_GET['message'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC INSTITUTE</title>
    <link rel="stylesheet" href="style-view_profile.css">
    <link rel="stylesheet" href="admin/css/menu.css">

</head>
<body>
<div class="container1">
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
        <?php if ($message == 'update'): ?>
            <div class="alert alert-success" id="alertMessage"><i class="fas fa-check-circle"></i>Your details are updated successfully.</div>
        <?php endif; ?>
        <b><h1 class="topname"><span><?php echo isset($name) ? $name : ''; ?></span></h1></b>
        <br>
        <div class="p_data">
            <div class="personal_details">
                <h2>Personal Details</h2>
                <hr>
                <br>
                <div class="form-row">
                    <span class="form-label">User ID:</span>
                    <span class="form-value"><?php echo isset($username) ? $username : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">Phone No:</span>
                    <span class="form-value"><?php echo isset($phone) ? $phone : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">Date Of Birth:</span>
                    <span class="form-value"><?php echo isset($dob) ? $dob : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">NIC No:</span>
                    <span class="form-value"><?php echo isset($nic) ? $nic : ''; ?></span>
                </div>
                <div class="form-row">
                    <span class="form-label">E-mail:</span>
                    <span class="form-value"><?php echo isset($email) ? $email : ''; ?></span>
                </div>
                <button id="update-button" class="btn2">Update</button>
            </div>
        </div>
        <br><br>
    </div>
</div>

<!-- Modal Structure -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Profile</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="profile.php">
            <label for="update-name">Name:</label>
            <input type="text" id="update-name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
            <br><br>
            <label for="update-phone">Phone:</label>
            <input type="text" id="update-phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
            <br><br>
            <label for="update-dob">Date of Birth:</label>
            <input type="date" id="update-dob" name="dob" value="<?php echo isset($dob) ? $dob : ''; ?>" required>
            <br><br>
            <label for="update-nic">NIC:</label>
            <input type="text" id="update-nic" name="nic" value="<?php echo isset($nic) ? $nic : ''; ?>" required>
            <br><br>
            <label for="update-email">Email:</label>
            <input type="email" id="update-email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
            <br><br>
            <button type="submit" class="btn2">Save</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("updateModal");
        const updateButton = document.getElementById("update-button");
        const closeButton = document.querySelector(".modal .close");

        updateButton.addEventListener("click", function() {
            modal.style.display = "block";
        });

        closeButton.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });

        // Hide alert message after 10 seconds
        setTimeout(function() {
            var alertMessage = document.getElementById('alertMessage');
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
        }, 10000);
    });
</script>
</body>
</html>
