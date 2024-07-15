<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Tailwind CSS (required for Flowbite) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- Flowbite CSS -->
    <link href="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet">

</head>
<body class="body">
    <!-- Navbar -->

    <nav class="bg-black border-gray-200 fixed w-full top-0 left-0 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#home" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Gallery Cafe</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto bg-black" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-black md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-black dark:bg-gray-800 md:dark:bg-black dark:border-gray-700">
                    <li>
                    <a href="#home" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-yellow-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
                    </li>
                    <li>
                    <a href="#menu" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-yellow-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Menu</a>
                    </li>
                    <li>
                    <a href="#promotions" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-yellow-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Promotions & Offers</a>
                    </li>
                    <li>
                    <a href="#blogs" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-yellow-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About Us</a>
                    </li>
                    <li>
                    <a href="#contact" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-yellow-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                    </li>
                    <li>
                    <a href="#contact" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-yellow-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Online Orders</a>
                    </li>
                    <li>
                    <a href="#contact" class="block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-yellow-300 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Reserve</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="home">
        <button class="login-button">Login</button>
        <img class="home-pic" src="img/Untitled-1.jpg" alt="">
        <div class="para">
            <h1>The Gallery Cafe</h1>
            <p class="items-justify">
                Welcome to <strong>The Gallery Cafe</strong>, where culinary excellence meets unparalleled hospitality. Nestled in the heart of Kalutara, 
                our restaurant offers a vibrant dining experience that captures the essence of both local and international flavors. From our
                meticulously crafted dishes to our warm, inviting atmosphere, every detail is designed to delight your senses. Whether you're
                joining us for a casual lunch, an intimate dinner, or a special celebration, our dedicated team is committed to making your 
                visit unforgettable. Indulge in our diverse menu, savor our expertly paired wines, and immerse yourself in an ambiance that
                feels like home. Welcome to a place where every meal is a celebration, and every guest is family.
            </p>
            <div class="social items-center space-x-4 mt-4">
                <a href="https://github.com/RamithaHeshan33" target="_blank"><i class='bx bxl-github'></i></a>
                <a href="https://www.linkedin.com/in/ramithaheshan/" target="_blank"><i class='bx bxl-linkedin'></i></a>
                <a href="https://www.youtube.com/@RamithaHeshan" target="_blank"><i class='bx bxl-youtube'></i></a>
            </div>
        </div>
    </div>


    

    <div class="about">
        <h1>about</h1>
    </div>

    
  
    <!-- Navbar End -->
</body>

<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.js"></script>
</html>