<?php
require __DIR__ . '/vendor/autoload.php';
require '../connection.php';

// Stripe API key setup
$stripe_secret_key = 'sk_test_51PIMdPDwJDfpiSSr04muva7l4XmHisSOvB1AKimDn25sT7tkMB5TRWvAt7we5h3xMMpL6zjAAas2J7ktFAoERJ4600kydtwfzm';
\Stripe\Stripe::setApiKey($stripe_secret_key);

// Check if the request is from Stripe Checkout
if (isset($_GET['session_id'])) {
    // Retrieve the session ID
    $session_id = $_GET['session_id'];

    // Retrieve the session from Stripe
    $session = \Stripe\Checkout\Session::retrieve($session_id);

    // Check if the payment was successful
    if ($session->payment_status == 'paid') {
        // Retrieve reservation details from the session
        $slot_number = $_GET['slotNumber'];
        $vehicle_number = $_GET['vehicleNumber'];
        $reserve_date = $_GET['reserveDate'];
        $reserve_time = $_GET['reserveTime'];
        $exit_date = $_GET['exitDate'];
        $exit_time = $_GET['exitTime'];
        $username = $_GET['username'];
        $phone = $_GET['phone'];

        // Insert reservation details into the database
        $sql = "INSERT INTO parking_reservation (slot_number, vehicle_number, reserve_date, reserve_time, exit_date, exit_time, username, phone) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $conn->error);
        }

        $stmt->bind_param("isssssss", $slot_number, $vehicle_number, $reserve_date, $reserve_time, $exit_date, $exit_time, $username, $phone);

        if ($stmt->execute()) {
            header("Location: parking.php?message=reserved");
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo 'Payment failed.';
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle reservation request
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $slot_number = $_POST['slotNumber'];
    $vehicle_number = $_POST['vehicleNumber'];
    $reserve_date = $_POST['reserveDate'];
    $reserve_time = $_POST['reserveTime'];
    $exit_date = $_POST['exitDate'];
    $exit_time = $_POST['exitTime'];

    function isSlotAvailable($conn, $slot_number, $reserve_date, $reserve_time, $exit_date, $exit_time) {
        $sql = "SELECT COUNT(*) as count FROM parking_reservation WHERE slot_number = ? AND (
                    (reserve_date <= ? AND exit_date >= ?) OR
                    (reserve_date <= ? AND exit_date >= ?) OR
                    (reserve_date >= ? AND exit_date <= ?)
                )";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing statement: ' . $conn->error);
        }
        $stmt->bind_param("issssss", $slot_number, $reserve_date, $reserve_date, $exit_date, $exit_date, $reserve_date, $exit_date);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return $row['count'] == 0;
    }

    // Check if the slot is available
    if (isSlotAvailable($conn, $slot_number, $reserve_date, $reserve_time, $exit_date, $exit_time)) {
        // Start a new Stripe Checkout session
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                        'name' => 'Parking Reservation',
                    ],
                    'unit_amount' => 100000, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:3000/parking/checkout.php?session_id={CHECKOUT_SESSION_ID}&slotNumber=' . urlencode($slot_number) . 
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
        header("Location: parking.php?message=slot_unavailable");
        exit();
    }
} else {
    echo 'Invalid request method.';
}
?>
