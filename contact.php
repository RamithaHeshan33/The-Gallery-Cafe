<?php
    require 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <div class="contact-in">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9316609954235!2d79.8522972750435!3d6.8987769931004665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259602cb3bc09%3A0x677419394138f674!2sThe%20Gallery%20Caf%C3%A9!5e0!3m2!1sen!2slk!4v1722616987707!5m2!1sen!2slk" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="contact-form">
            <h1>Contact Us</h1>
            <form action="https://api.web3forms.com/submit" method="POST">
                <input type="hidden" name="access_key" value="ae11ec17-6145-472d-87ba-bfd9ba032019">
                <input type="text" name="name" placeholder="Name" class="contact-form-txt" required>
                <input type="email" name="email" placeholder="Email" class="contact-form-txt" required>
                <textarea name="message" cols="30" rows="10" placeholder="Message" class="contact-form-txtarea" required></textarea>
                <input type="submit" class="contact-form-btn">
            </form>
        </div>

    </div>
</body>
</html>