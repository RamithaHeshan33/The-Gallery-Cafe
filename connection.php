<?php
$server = 'localhost:3307';
$username = 'root';
$password = '';
$database = 'gallery_cafe';

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
