<?php
/*
This script sets up the initial database tables for the blog platform.
Created by Mustafa Naseer for URUFI project.
*/

// this is requier tables for projects you can use using this commend in php Cli (php setup_database.php)

// Include database configuration and connect to the database
$pdo = require __DIR__ . 'database.php';

// Define SQL queries to create tables
$sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);";

// Execute the SQL queries
try {
    // Execute multiple queries in a single call
    $pdo->exec($sql);
    echo "Tables created successfully!";
} catch (PDOException $e) {
    // Catch and display errors
    echo "Error creating tables: " . $e->getMessage();
}
