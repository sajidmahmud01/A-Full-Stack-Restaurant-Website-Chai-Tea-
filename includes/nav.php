<header>
    <nav class="navbar">
        <a href="index.php" class="nav-link">Home</a>
        <a href="menu.php" class="nav-link">Menu</a>
        <a href="about.php" class="nav-link">About</a>
        <a href="contact.php" class="nav-link">Contact</a>
        <a href="cart.php" class="nav-cart">
            <span class="cart-icon">🛒</span>
            <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
        </a>
    </nav>
</header> 