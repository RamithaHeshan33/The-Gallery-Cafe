<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Cafe</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="../img/title.png">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        nav {
            background-color: black;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 50;
            border-bottom: 1px solid #333;
        }

        nav .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: yellow;
        }

        nav .brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav .toggle-button {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: white;
        }

        nav .toggle-button svg {
            fill: white;
            width: 24px;
            height: 24px;
        }

        nav .nav-links {
            display: flex;
            gap: 1rem;
        }

        nav .nav-links a.active-link {
            border-bottom: 2px solid yellow;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #575757;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .profile {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            nav .nav-links {
                display: none;
                flex-direction: column;
                background-color: black;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                border-top: 1px solid #333;
            }

            nav .nav-links a {
                padding: 15px;
                border-bottom: 1px solid #333;
            }

            nav .nav-links.show {
                display: flex;
            }

            nav .toggle-button {
                display: inline-block;
            }
        }

        @media (max-width: 390px) {
            .dropdown-content {
                right: auto;
                left: 0;
                min-width: 100px;
            }

            .profile {
                width: 25px;
                height: 25px;
            }
        }
    </style>
</head>
<body id="home">
    <!-- Navbar -->
    <nav>
        <div class="container">
            <a href="admin.php" class="brand">Gallery Cafe</a>
            <button class="toggle-button" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only"></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <div class="nav-links" id="navbar-default">
                <a href="admin.php">Home</a>
                <a href="menu.php">Menu</a>
                <a href="promo.php">Offers</a>
                <a href="order.php">Online Orders</a>
                <a href="events.php">Events</a>
                <a href="reservation.php">Reserve</a>
            </div>
            <div class="dropdown">
                <img src="../img/profile.png" alt="Profile" class="profile">
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <a href="user_profiles.php">Users</a>
                    <a href="park-reservation.php">Parking Reservations</a>
                    <a href="table-reservation.php">Table Reservations</a>
                    <a href="staff.php">Manage Staff</a>
                    <a href="../index.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('nav .nav-links a');
            const currentPath = window.location.pathname.split('/').pop();

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath || (currentPath === '' && link.getAttribute('href') === 'admin.php')) {
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
