<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Cafe</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" type="image/png" href="img/restaurant.png">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            nav .nav-links a {
                padding: 10px;
            }
        }
    </style>
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
