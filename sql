CREATE DATABASE purchase_order_db;

USE purchase_order_db;

CREATE TABLE purchase_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_number VARCHAR(50),
    customer_name VARCHAR(100),
    product_name VARCHAR(100),
    quantity INT,
    price DECIMAL(10, 2),
    total DECIMAL(10, 2),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
