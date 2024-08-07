<?php
/*
This blog platform is built by Mustafa Naseer for Zainiq tasks.
It's open-source code, and anyone can access it on my GitHub account.
*/

// Include the database connection file to get the PDO instance
$pdo = require __DIR__ . '/../config/database.php';

// Include the PostController and UserController files
require_once __DIR__ . '/../app/controllers/PostController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

// Create instances of the PostController and UserController with the PDO instance
$postController = new PostController($pdo);
$userController = new UserController($pdo);

// Parse the current URL path to determine which action to take
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Start the session to manage user sessions -> (i add it to routes to not recall it in every page)
session_start();

// Use a switch statement to handle different URL paths and call the corresponding controller methods
switch ($url) {
    case '/':
        // Call the index method of the PostController for the home page
        $postController->index();
        break;

    case '/post/create':
        // Call the create method of the PostController to create a new post
        $postController->create();
        break;

    case (preg_match('/^\/post\/edit\/(\d+)$/', $url, $matches) ? true : false):
        // Call the edit method of the PostController to edit a specific post using the post ID
        $postController->edit($matches[1]);
        break;

    case (preg_match('/^\/post\/delete\/(\d+)$/', $url, $matches) ? true : false):
        // Call the delete method of the PostController to delete a specific post using the post ID
        $postController->delete($matches[1]);
        break;

    case (preg_match('/^\/post\/(\d+)$/', $url, $matches) ? true : false):
        // Call the show method of the PostController to display a specific post using the post ID
        $postController->show($matches[1]);
        break;

    case (preg_match('/^\/post\/create_comment\/(\d+)$/', $url, $matches) ? true : false):
        // Call the create_comment method of the PostController to create a comment for a specific post using the post ID
        $postController->create_comment($matches[1]);
        break;

    case '/login':
        // Call the login method of the UserController to handle user login
        $userController->login();
        break;

    case '/register':
        // Call the register method of the UserController to handle user registration
        $userController->register();
        break;

    case '/logout':
        // Call the logout method of the UserController to handle user logout
        $userController->logout();
        break;

    default:
        // If the URL path does not match any of the above cases, return a 404 error
        http_response_code(404);
        echo 'Page not found';
        break;
}
