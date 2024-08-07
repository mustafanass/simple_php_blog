<?php
/*
This blog platform is built by Mustafa Naseer for Zainiq tasks.
It's open-source code, and anyone can access it on my GitHub account.
*/

require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $userModel;

    // Constructor to initialize the User model with a PDO connection
    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    // Method to handle user login
    public function login()
    {
        // Check if the request method is POST requests
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email']; // Get the email from the request
            $password = $_POST['password']; // Get the password from the request

            // Fetch the user by email from the model
            $user = $this->userModel->getUserByEmail($email);
            
            // Verify the password and check if the user exists
            if ($user && password_verify($password, $user['password'])) {
                // Store user information in the session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: /"); // Redirect to the homepage after successful login
                exit();
            } else {
                $error = "email or password not correct"; // Set error message if login fails
            }
        }

        require __DIR__ . '/../views/users/login.php'; // Load the login view
    }

    // Method to handle user registration
    public function register()
    {
        $error = ''; // Initialize error variable
    
        // Check if the request method is POST requests
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']); // Get the username from the request
            $email = trim($_POST['email']); // Get the email from the request
            $password = $_POST['password']; // Get the password from the request
            /*
            Validation :
            check email Validation -> using filter_var
            check password length -> its should be 6 or more 
            check email , username if its already in database
            * after check each error should have its string alert using $error var
            */

            // Check if email is in the correct format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format."; // Set error message for invalid email
            } elseif ($this->userModel->getUserByEmail($email)) {
                // Check if the email already exists
                $error = "Email already in use."; // Set error message for existing email
            }
    
            // Check if password length is greater than 8 characters
            if (strlen($password) < 8) {
                $error = "Password must be at least 8 characters."; // Set error message for short password
            }
    
            // If there are no errors, create the user
            if (empty($error)) {
                $this->userModel->createUser($username, $email, $password); // Create a new user
                header("Location: /login"); // Redirect to the login page after successful registration
                exit();
            }
        }
    
        // Pass errors to the view
        require __DIR__ . '/../views/users/register.php'; // Load the registration view
    }

    // Method to handle user logout
    public function logout()
    {
        session_start(); // Start the session
        session_destroy(); // Destroy the session to log the user out
        header("Location: /login"); // Redirect to the login page after logout
        exit();
    }
}
