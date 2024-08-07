<?php
/*
This blog platform is built by Mustafa Naseer for Zainiq tasks.
It's open-source code, and anyone can access it on my GitHub account.
*/

class User
{
    private $pdo; // PDO instance for database connection

    // Constructor to initialize the User class with a PDO connection
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Method to retrieve a user by their email address
    public function getUserByEmail($email)
    {
        // Prepare a SQL statement to select a user with the given email
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        
        // Execute the prepared statement with the provided email
        $stmt->execute([$email]);
        
        // Fetch and return the user record if it exists
        return $stmt->fetch();
    }

    // Method to create a new user in the database
    public function createUser($username, $email, $password)
    {
        // Prepare a SQL statement to insert a new user with hashed password
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        
        // Execute the prepared statement with the provided username, email, and hashed password
        $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
    }
}
