
CREATE DATABASE brightbizz;
USE brightbizz;

CREATE TABLE IF NOT EXISTS admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY, 
    Username VARCHAR(100) NOT NULL UNIQUE, 
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS inventory (
    Product_id INT AUTO_INCREMENT PRIMARY KEY,
    Product_name VARCHAR(100) NOT NULL,
    Price DECIMAL(10,2) NOT NULL,
    Stock INT NOT NULL,
    Quantity INT NOT NULL,
    Remaining_stock INT AS (Stock - Quantity) STORED,
    Total_amount DECIMAL(10,2) AS (Price * Quantity) STORED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    admin_id INT,
    FOREIGN KEY (admin_id) REFERENCES admin(admin_id) ON DELETE SET NULL
);


INSERT INTO admin (username, password) VALUES
('admin', '$2y$10$qvbfXZLoppmr/kc6NvmuF.u4HVH9ntA7jQoCYCE9lT9Nvwf37t3Ym');