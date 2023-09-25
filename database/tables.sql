CREATE DATABASE IF NOT EXISTS telds_shop;

USE telds_shop;

CREATE TABLE IF NOT EXISTS products (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        name VARCHAR(255) NOT NULL,
                                        description TEXT,
                                        price DECIMAL(10, 2) NOT NULL,
                                        image BLOB NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     password VARCHAR(255) NOT NULL,
                                     email VARCHAR(255) NOT NULL,
                                     address VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS payment_methods (
                                               id INT AUTO_INCREMENT PRIMARY KEY,
                                               name VARCHAR(255) NOT NULL,
                                               is_active BOOLEAN NOT NULL DEFAULT true
);

CREATE TABLE IF NOT EXISTS carts (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     product_id INT NOT NULL,
                                     user_id INT NOT NULL,
                                     quantity INT NOT NULL,
                                     payment_method VARCHAR(255),
                                     is_paid BOOLEAN DEFAULT 0,
                                     FOREIGN KEY (product_id) REFERENCES products(id),
                                     FOREIGN KEY (user_id) REFERENCES users(id)
);