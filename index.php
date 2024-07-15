<?php
session_start();
include_once('connection.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['user_type'];

    if (empty($username) && empty($password)) {
        echo "<script>alert('Please Fill Username and Password'); window.location='index.php';</script>";
        exit;
    } elseif (empty($password)) {
        echo "<script>alert('Please Fill Password'); window.location='index.php';</script>";
        exit;
    } elseif (empty($username)) {
        echo "<script>alert('Please Fill Username'); window.location='index.php';</script>";
        exit;
    } else {
        $table = "";
        $redirectPath = "";
        if ($userType == 'admin') {
            $table = "admin_login_tbl";
            $redirectPath = 'admin/admin.php';
        }
        
        elseif ($userType == 'staff') {
            $table = "staff";
            $redirectPath = 'staff/staff.php';
        } else {
            echo "<script>alert('Invalid User Type'); window.location='index.php';</script>";
            exit;
        }

        $sql = "SELECT * FROM `$table` WHERE `username`='$username' AND `password`='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $name = $row['name'];
            $storedUsername = $row['username'];
            $storedPassword = $row['password'];

            if ($username == $storedUsername && $password == $storedPassword) {
                $_SESSION['name'] = $name;
                $_SESSION['username'] = $username;
                header('location: ' . $redirectPath);
                exit;
            }
        } else {
            echo "<script>alert('Invalid Username or Password'); window.location='index.php';</script>";
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h1>The Gallery Cafe</h1>
        <img src="img/meal.png" alt="Login Image">
        <form action="" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <select name="user_type" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff Member</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
    </div>
</body>
</html>