<?php
require __DIR__ . '/vendor/autoload.php';

// Stripe API key setup
$stripe_secret_key = 'sk_test_51PIMdPDwJDfpiSSr04muva7l4XmHisSOvB1AKimDn25sT7tkMB5TRWvAt7we5h3xMMpL6zjAAas2J7ktFAoERJ4600kydtwfzm';
\Stripe\Stripe::setApiKey($stripe_secret_key);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $amount = $_POST['amount'];
    $username = $_POST['username'];

    // Start a new Stripe Checkout session
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'lkr',
                'product_data' => [
                    'name' => 'Shopping Cart Purchase',
                ],
                'unit_amount' => $amount,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost:3000/orders/success.php?username=' . urlencode($username) . '&amount=' . urlencode($amount / 100),
        'cancel_url' => 'http://localhost:3000/orders/cart.php',
    ]);

    header('HTTP/1.1 303 See Other');
    header('Location: ' . $checkout_session->url);
    exit();
} else {
    echo 'Invalid request method.';
}
?>
