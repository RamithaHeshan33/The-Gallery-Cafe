<?php
$server = 'localhost:3307';
$username = 'root';
$password = '';
$database = 'gallery_cafe';

if (isset($_POST)) {
    $conn = new mysqli($server, $username, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

}

else {
    // Handle the case where no POST data is set
    echo "No POST data received.";
}
?>
