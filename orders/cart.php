<?php
session_start();

// Include the database connection
include_once('../connection.php');

// Include Stripe PHP library
require __DIR__ . '/vendor/autoload.php';

// Stripe API key setup
$stripe_secret_key = 'sk_test_51PIMdPDwJDfpiSSr04muva7l4XmHisSOvB1AKimDn25sT7tkMB5TRWvAt7we5h3xMMpL6zjAAas2J7ktFAoERJ4600kydtwfzm';
\Stripe\Stripe::setApiKey($stripe_secret_key);

$username = $_SESSION['username'];
$sql = "SELECT * FROM cart WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div class="res-container">
    <div class="table-container-2">
        <h1>Shopping Cart</h1>
        <a href="order.php">Order Menu</a>
        <div class="table">
            <table>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
                <?php
                $grandTotal = 0; // Initialize grand total
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $total = $row['price'] * $row['quantity'];
                        $grandTotal += $total; // Add to grand total
                        echo "<tr>";
                        echo "<td data-cell='Username'>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Name'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Price'>" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Quantity'>" . htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td data-cell='Status'>
                                <form method='post' action='update_quantity.php' style='display:inline-block;'>
                                    <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                    <input type='number' name='quantity' value='" . $row['quantity'] . "' min='1'>
                                    <input type='submit' value='Update' class='btn2'>
                                </form>
                                <form method='post' action='delete_item.php' style='display:inline-block;'>
                                    <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                    <input type='submit' value='Delete' class='btn3'>
                                </form>
                              </td>";
                        echo "<td data-cell='Total'>" . htmlspecialchars($total, ENT_QUOTES, 'UTF-8') . " LKR</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No items in cart</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="5" style="text-align:right;"><strong>Grand Total:</strong></td>
                    <td data-cell="Grand Total"><strong><?php echo htmlspecialchars($grandTotal, ENT_QUOTES, 'UTF-8'); ?> LKR</strong></td>
                </tr>
            </table>
        </div>
        <!-- Stripe payment form -->
        <div class="form">
            <form action="process_payment.php" method="post" id="payment-form">
                <input type="hidden" name="amount" value="<?php echo $grandTotal * 100; ?>"> <!-- Amount in cents -->
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit" class="btn2">Pay</button>
            </form>
        </div>
        
    </div>
</div>
</body>
</html>
<?php
$conn->close();
?>
