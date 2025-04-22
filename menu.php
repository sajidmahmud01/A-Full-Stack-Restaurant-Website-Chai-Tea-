<?php
session_start();
require_once 'includes/db.php';

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['total'] = 0;
}

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    $item = getMenuItem($database, $item_id);
    if ($item) {
        $_SESSION['cart'][] = array(
            'id' => $item['id'],
            'name' => $item['name'],
            'price' => $item['price']
        );
        $_SESSION['total'] += $item['price'];
        $success_message = "Item added to cart!";
    }
}

// Handle remove from cart
if (isset($_POST['remove_from_cart'])) {
    $index = $_POST['item_index'];
    $_SESSION['total'] -= $_SESSION['cart'][$index]['price'];
    array_splice($_SESSION['cart'], $index, 1);
    header('Location: menu.php');
    exit();
}

// Handle checkout
if (isset($_POST['checkout'])) {
    if (empty($_SESSION['cart'])) {
        $error = "Your cart is empty!";
    } else {
        $success = "Thank you for your order! Total: $" . number_format($_SESSION['total'], 2);
        $_SESSION['cart'] = array();
        $_SESSION['total'] = 0;
    }
}

// Get menu items from database
$menu_items = getMenuItems($database);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Tong Cha</title>
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/nav.php'; ?>

    <main>
        <div class="menu-container">
            <div class="menu-header">
                <h1 class="section-title">Our Menu</h1>
                <a href="cart.php" class="cart-link">
                    Cart (<?php echo count($_SESSION['cart']); ?> items)
                </a>
            </div>

            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if (isset($success_message)): ?>
                <div class="success-message">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <div class="menu-grid">
                <?php while ($item = mysqli_fetch_assoc($menu_items)): ?>
                    <div class="menu-item">
                        <img src="<?php echo $item['image_path']; ?>" alt="<?php echo $item['name']; ?>">
                        <h3><?php echo $item['name']; ?></h3>
                        <p><?php echo $item['description']; ?></p>
                        <span class="price">$<?php echo number_format($item['price'], 2); ?></span>
                        <form method="POST">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Auto-hide success message after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('.success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>
</html> 