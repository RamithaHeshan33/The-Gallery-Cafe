<?php
require __DIR__ . '/vendor/autoload.php';

// Stripe API key setup
$stripe_secret_key = 'sk_test_51PIMdPDwJDfpiSSr04muva7l4XmHisSOvB1AKimDn25sT7tkMB5TRWvAt7we5h3xMMpL6zjAAas2J7ktFAoERJ4600kydtwfzm';
\Stripe\Stripe::setApiKey($stripe_secret_key);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $slot_number = $_POST['slotNumber'];
    $vehicle_number = $_POST['vehicleNumber'];
    $reserve_date = $_POST['reserveDate'];
    $reserve_time = $_POST['reserveTime'];
    $exit_date = $_POST['exitDate'];
    $exit_time = $_POST['exitTime'];

    // Start a new Stripe Checkout session
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Parking Reservation', // Adjust the product name as needed
                ],
                'unit_amount' => 1000, // Adjust the amount as needed (in cents)
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost:3000/parking/checkout.php?slotNumber=' . urlencode($slot_number) . 
                         '&vehicleNumber=' . urlencode($vehicle_number) . 
                         '&reserveDate=' . urlencode($reserve_date) . 
                         '&reserveTime=' . urlencode($reserve_time) . 
                         '&exitDate=' . urlencode($exit_date) . 
                         '&exitTime=' . urlencode($exit_time) . 
                         '&username=' . urlencode($username) .
                         '&phone=' . urlencode($phone),
        'cancel_url' => 'http://localhost:3000/parking/parking.php',
    ]);

    header('HTTP/1.1 303 See Other');
    header('Location: ' . $checkout_session->url);
    exit();
} else {
    echo 'Invalid request method.';
}
?>
