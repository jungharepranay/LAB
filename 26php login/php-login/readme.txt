CREATE DATABASE 26db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique user ID
    username VARCHAR(100) NOT NULL,     -- User's name
    email VARCHAR(100) NOT NULL UNIQUE, -- User's email, must be unique
    password VARCHAR(255) NOT NULL,     -- Hashed password
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp for account creation
);

http://localhost:8080/php-login/index.php