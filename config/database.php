<?php
/*
This blog platform is built by Mustafa Naseer for Zainiq tasks.
It's open-source code, and anyone can access it on my GitHub account.
*/

// Database connection details
$host = '127.0.0.1:3306'; // Database host with port number
$db = 'blog_platform';    // Name of the database
$user = 'urufi_access';   // Username for database access
$pass = 'maadar@112233';  // Password for database access

try {
    // Create a new PDO instance for connecting to the MySQL database
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Set the PDO error mode for exception suggest by php communtiy form
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Catch any PDO exceptions and terminate the script with an error message
    die("Could not connect to the database: " . $e->getMessage());
}

// Return the PDO instance for database operations
return $pdo;
