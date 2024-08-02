<?php
session_start();
require 'connection.php';

// Handle registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $nic = $_POST['nic'];
    $confirm_password = $_POST['confirm_password'];
    $accept_terms = isset($_POST['accept_terms']);

    // Validate inputs (you can add more validation as needed)
    if ($password === $confirm_password) {
        if ($accept_terms) {
            // Hash the password before storing it in the database (recommended for security)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $sql = "INSERT INTO users (username, password, name, email, phone, dob, nic) VALUES ('$username', '$hashed_password', '$name', '$email', '$phone', '$dob', '$nic')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['username'] = $username; // Start session for the new user
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $error = "You must accept the privacy policy and terms and conditions.";
        }
    } else {
        $error = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - The Gallery Cafe</title>
    <link rel="icon" type="image/png" href="img/title.png">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: calc(100% - 10px);
            padding: 8px 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }
        .form-group .checkbox-label {
            display: inline;
        }
        .form-group .terms a {
            color: #007BFF;
            text-decoration: none;
        }
        .form-group .terms a:hover {
            text-decoration: underline;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #ffcc00;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #ff9900;
        }
        .error {
            color: red;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .text-center {
            text-align: center;
        }
        .text-center a {
            color: #007BFF;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" required>
            </div>
            <div class="form-group">
                <label for="nic">NIC Number</label>
                <input type="text" name="nic" id="nic" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <input type="checkbox" name="accept_terms" id="accept_terms" required>
                <label for="accept_terms" class="checkbox-label">I accept the <a href="privacy_policy.php">privacy policy</a> and <a href="terms_conditions.php">terms and conditions</a>.</label>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
