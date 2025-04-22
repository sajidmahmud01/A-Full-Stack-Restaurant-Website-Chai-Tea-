# Tong Cha Website - How It Works

This website is a restaurant-style web application built with PHP and integrated with a MySQL database. It dynamically fetches menu data and images from the database, allowing customers to browse items and place orders directly through the site.

The shopping cart functionality is managed using PHP, enabling users to add or remove items seamlessly. Upon checkout, order details are recorded in the database, providing real-time tracking of customer purchases and order history.

## 1. The Database (`database.sql`)

This SQL script populates the database with initial data (Lines 32-42) for the refreshments and snacks menu categories, making them available for display and ordering on the website.

## 2. Talking to the Database (`includes/db.php`)

### Connecting to the Database (Lines 1–15)

- Establishes a connection between the website and the database using stored credentials.
- If the connection fails, the process halts and displays an error message.

### Menu & Order Functions (Lines 18–72)

- These functions handle fetching menu items, placing new orders, and displaying past orders.
- They ensure data integrity by properly saving or rolling back transactions in case of errors.

## Our Files

| File Name      | Description                                              |
|----------------|----------------------------------------------------------|
| `database.sql` | Adds initial menu data to the database.                  |
| `db.php`       | Connects the website to the database.                    |
| `nav.php`      | Top navigation bar for all pages.                        |
| `footer.php`   | Footer section displayed on every page.                  |
| `menu.php`     | Displays all menu items categorized appropriately.       |
| `cart.php`     | Manages adding and removing items from the shopping cart.|
| `index.php`    | Homepage featuring a welcome message and menu access.    |
| `main.css`     | Controls the visual styling of the website.              |
