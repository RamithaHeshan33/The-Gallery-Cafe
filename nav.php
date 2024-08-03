<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Cafe</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="admin/css/nav.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="img/restaurant.png">

</head>
<body id="home">
    <!-- Navbar -->
    <nav>
        <div class="container">
            <a href="user.php" class="brand">Gallery Cafe</a>
            <button class="toggle-button" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only"></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <div class="nav-links" id="navbar-default">
                <a href="user.php" class="home-link">Home</a>
                <a href="menu1.php">Menu</a>
                <a href="about.php">About Us</a>
                <a href="services.php">Services</a>
                <a href="contact.php">Contact Us</a>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('nav .nav-links a');
            const currentPath = window.location.pathname.split('/').pop();

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active-link');
                } else {
                    link.classList.remove('active-link');
                }
            });

            const toggleButton = document.querySelector('.toggle-button');
            const navLinksContainer = document.querySelector('.nav-links');

            toggleButton.addEventListener('click', () => {
                navLinksContainer.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
