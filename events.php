<?php
require 'parking/nav1.php';

require 'connection.php';

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/service.css">
</head>
<body class="body">
    <?php if ($result->num_rows > 0): ?>
        <?php while($promo = $result->fetch_assoc()): ?>
            <div class="home">
                <?php if (!empty($promo['image'])): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($promo['image']) ?>" alt="" class="home-pic">
                <?php else: ?>
                    <img src="img/s.jpg" alt="" class="home-pic">
                <?php endif; ?>
                <div class="para">
                    <h2><?= $promo['title'] ?></h2>
                    <p>
                        <?= $promo['description'] ?>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="home">
            <img src="img/empty.jpg" alt="" class="home-pic">
            <div class="para">
                <h1>No offers available</h1>
                <p>Currently, there are no promotions available.</p>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
