-- Create menu_items table
CREATE TABLE menu_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_path VARCHAR(255),
    category VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create orders table
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    total_amount DECIMAL(10,2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pending'
);

-- Create order_items table
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    menu_item_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id)
);

-- Insert sample menu items
INSERT INTO menu_items (name, description, price, image_path, category) VALUES
('Classic Milk Tea', 'Traditional black tea with milk', 3.99, 'Images/TeaShop.jpg', 'Refreshments'),
('Ginger Tea', 'Spicy ginger infused tea', 4.29a, 'Images/TeaShop.jpg', 'Refreshments'),
('Masala Tea', 'Spiced tea with aromatic spices', 4.49, 'Images/TeaShop.jpg', 'Refreshments'),
('Cardamon Tea', 'Tea infused with cardamom pods', 4.29, 'Images/TeaShop.jpg', 'Refreshments'),
('Mango Lacchi', 'Sweet mango yogurt drink', 3.99, 'Images/TeaShop.jpg', 'Refreshments'),
('Plain Lacchi', 'Traditional yogurt drink', 3.99, 'Images/TeaShop.jpg', 'Refreshments'),
('Samosa', 'Crispy pastry with spiced filling', 2.99, 'Images/TeaShop.jpg', 'Snacks'),
('Pakora', 'Crispy vegetable fritters', 3.99, 'Images/TeaShop.jpg', 'Snacks'),
('Paratha Roll', 'Flatbread wrap with filling', 3.49, 'Images/TeaShop.jpg', 'Snacks'),
('Chicken Puff', 'Flaky pastry with chicken filling', 3.99, 'Images/TeaShop.jpg', 'Snacks'); 