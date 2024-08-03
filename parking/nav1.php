<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Cafe</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../admin/css/nav.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="../img/title.png">

</head>
<body id="home">
    <!-- Navbar -->
    <nav>
        <div class="container">
            <a href="staff.php" class="brand">Gallery Cafe</a>
            <button class="toggle-button" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <div class="nav-links" id="navbar-default">
                <a href="../user1.php" class="block">Home</a>
                <a href="../menu.php" class="block">Menu</a>
                <a href="../promo.php" class="block">Offers</a>
                <a href="../events.php">Events</a>
                <a href="../orders/order.php" class="block">Online Orders</a>
                <a href="../reservation.php" class="block">Reserve</a>
                <a href="../contact1.php">Contact Us</a>

            </div>
            <div class="dropdown">
                <img src="../img/profile.png" alt="" class="profile">
                <div class="dropdown-content">
                    <a href="../profile.php">Profile</a>
                    <a href="../park-reservation.php">Parking Reservations</a>
                    <a href="../Table-reservation.php">Table Reservations</a>
                    <a href="../user.php">Logout</a>
                </div>
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
                }
                link.addEventListener('click', function() {
                    navLinks.forEach(nav => nav.classList.remove('active-link'));
                    link.classList.add('active-link');
                });
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
