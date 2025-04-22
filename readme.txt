Tong Cha Website - How It Works
=============================

This website is a restaurant-style web application built with PHP and integrated with a MySQL database. It dynamically fetches menu data and images from the database, allowing customers to browse items and place orders directly through the site.
The shopping cart functionality is managed using PHP, enabling users to add or remove items seamlessly. Upon checkout, order details are recorded in the database, providing real-time tracking of customer purchases and order history.

1. The Database (database.sql)
----------------------------
This SQL script populates the database with initial data(Line 32-42) for the refreshments and snacks menu categories, making them available for display and ordering on the website.


2. Talking to the Database (includes/db.php)
-----------------------------------------
Connecting to the Database (Lines 1–15)
This part connects the website to the database using saved login info.
If the connection fails, it stops and shows an error message.

Menu & Order Functions (Lines 18–72)
These functions fetch menu items, place new orders, and show past orders.
They make sure everything is saved properly or cancelled if something goes wrong.


Our Files
-----------
database.sql – Adds initial menu data to the database.
db.php – Connects the website to the database.
nav.php – Top navigation bar for all pages.
footer.php – Footer section shown on every page.
menu.php – Shows all menu items by category.
cart.php – Handles adding/removing items from the cart.
index.php – Homepage with welcome and menu access.
main.css – Controls the website’s visual style.



