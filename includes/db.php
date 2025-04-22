<?php
define('SERVER', "peicloud.ca");
define('USERNAME', 'u183');
define('PASSWORD','u183');
define('DATABASE','db183');

$conn = new mysqli( SERVER, USERNAME, PASSWORD, DATABASE);


if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

// Connect to MySQL
if (!($database = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE))) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to get all menu items
function getMenuItems($database) {
    $query = "SELECT * FROM menu_items ORDER BY category, name";
    $result = mysqli_query($database, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($database));
    }
    return $result;
}

// Function to get menu item by ID
function getMenuItem($database, $id) {
    $query = "SELECT * FROM menu_items WHERE id = $id";
    $result = mysqli_query($database, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($database));
    }
    return mysqli_fetch_assoc($result);
}

// Function to create a new order
function createOrder($database, $items, $total) {
    // Start transaction
    mysqli_begin_transaction($database);
    
    try {
        // Create order
        $query = "INSERT INTO orders (total_amount) VALUES ($total)";
        if (!mysqli_query($database, $query)) {
            throw new Exception(mysqli_error($database));
        }
        $orderId = mysqli_insert_id($database);
        
        // Add order items
        foreach ($items as $item) {
            $query = "INSERT INTO order_items (order_id, menu_item_id, quantity, price) 
                     VALUES ($orderId, {$item['id']}, 1, {$item['price']})";
            if (!mysqli_query($database, $query)) {
                throw new Exception(mysqli_error($database));
            }
        }
        
        mysqli_commit($database);
        return $orderId;
    } catch (Exception $e) {
        mysqli_rollback($database);
        throw $e;
    }
}

// Function to get order history
function getOrderHistory($database) {
    $query = "SELECT o.*, oi.quantity, oi.price, mi.name as item_name 
              FROM orders o 
              JOIN order_items oi ON o.id = oi.order_id 
              JOIN menu_items mi ON oi.menu_item_id = mi.id 
              ORDER BY o.order_date DESC";
    $result = mysqli_query($database, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($database));
    }
    return $result;
} 