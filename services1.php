<?php
    require 'nav2.php';
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

    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        };
        setTimeout("preventBack()", 0);
        window.onunload = function() {null;}

    </script>
</head>
<body class="body">
    <div class="home">
        <img src="img/parking1.jpg" alt="" class="home-pic">
        <div class="para">
            <h1>Parking Area</h1>
            <p>
                At The Gallery Café, we understand the importance of convenience for our valued guests. Our restaurant offers a spacious
                 parking area with 20 dedicated parking slots, ensuring a hassle-free experience from the moment you arrive. Whether you're
                  joining us for a quick meal or a leisurely dining experience, our ample parking facilities provide easy access and peace
                   of mind. We look forward to welcoming you and making your visit as comfortable as possible.

                <br> <br>

                Located conveniently close to the entrance, our parking facilities are designed to provide easy access and ensure your
                 vehicle is safe while you dine with us. And you can book a parking slot to park your vehicle through our website before
                  you come to the restaurant.
            </p>
            <div class="btn">
                <a href="reservation.php" class="btn2">Reserve</a>
            </div>
        </div>
    </div>

    <div class="about">
        <div class="para">
            <h1>Table Reservation</h1>
            <p>
                At The Gallery Café, we believe that planning your dining experience should be as enjoyable as the meal itself. To ensure you
                 have the perfect spot for your visit, we offer an easy and convenient table reservation system through our website. Whether
                  you're planning a romantic dinner, a family gathering, or a business lunch, our online reservation platform allows you to
                   select your preferred date, time, and table with just a few clicks. This way, you can focus on enjoying your time with us,
                    knowing your table is ready when you arrive.

                   <br> <br>

                Our reservation system is designed to accommodate your needs and preferences, providing real-time availability and instant
                 confirmation. You can also specify any special requests or dietary requirements during the booking process, ensuring a
                  personalized and delightful dining experience. 
            </p>

            <div class="btn">
                <a href="reservation.php" class="btn2">Reserve</a>
            </div>
        </div>
            <img src="img/restaurant.jpg" alt="">
        
        
    </div>

    <div class="home">
        <img src="img/service3.jpg" alt="" class="home-pic">
        <div class="para">
            <h1>Online Food Reservations</h1>
            <p>
                Experience the convenience of dining with The Gallery Café from the comfort of your home. Our online food reservation service
                 allows you to pre-order your favorite dishes through our website, ensuring your meal is prepared fresh and ready for you
                  upon arrival. Whether you're planning a quick lunch, a family dinner, or a special celebration, our user-friendly platform
                   lets you browse our diverse menu, customize your order, and select your preferred pick-up or dine-in time. This seamless
                    process guarantees that your dining experience is both efficient and enjoyable.

                <br> <br>

                Our online food reservation system is designed to accommodate your busy lifestyle while maintaining the quality and flavor
                 you expect from The Gallery Café. With real-time updates and instant confirmation, you can trust that your order will be
                  handled with care and precision.
            </p>
            <div class="btn">
                <a href="orders/order.php" class="btn2">Reserve</a>
            </div>
        </div>
    </div>
</body>
</html>