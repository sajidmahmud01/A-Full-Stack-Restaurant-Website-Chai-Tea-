<?php
session_start();
require_once 'includes/db.php';

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['total'] = 0;
}

// Handle remove item
if (isset($_POST['remove_item'])) {
    $index = $_POST['item_index'];
    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['total'] -= $_SESSION['cart'][$index]['price'];
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Handle checkout
if (isset($_POST['checkout']) && !empty($_SESSION['cart'])) {
    try {
        $order_id = createOrder($database, $_SESSION['cart'], $_SESSION['total']);
        if ($order_id) {
            $_SESSION['cart'] = array();
            $_SESSION['total'] = 0;
            $success_message = "Order placed successfully! Order ID: #" . $order_id;
        }
    } catch (Exception $e) {
        $error_message = "Error processing order. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Tong Cha</title>
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/nav.php'; ?>

    <main>
        <div class="cart-container">
            <h1 class="section-title">Shopping Cart</h1>
            <a href="menu.php" class="back-link">Back to Menu</a>

            <?php if (isset($success_message)): ?>
                <div class="success-message">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <?php if (empty($_SESSION['cart'])): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <div class="cart-item">
                        <h3><?php echo $item['name']; ?></h3>
                        <span class="price">$<?php echo number_format($item['price'], 2); ?></span>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="item_index" value="<?php echo $index; ?>">
                            <button type="submit" name="remove_item" class="remove-item">Remove</button>
                        </form>
                    </div>
                <?php endforeach; ?>

                <div class="cart-total">
                    <h3>Total: $<?php echo number_format($_SESSION['total'], 2); ?></h3>
                    <form method="POST">
                        <button type="submit" name="checkout" class="checkout-button">Proceed to Checkout</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html> 