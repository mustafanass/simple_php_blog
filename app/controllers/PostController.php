<?php
/*
This blog platform is built by Mustafa Naseer for Zainiq tasks.
It's open-source code, and anyone can access it on my GitHub account.
*/

require_once __DIR__ . '/../models/Post.php';

class PostController
{
    private $postModel;

    // Constructor to initialize the Post (which handle posts database functions) model with a PDO connection
    public function __construct($pdo)
    {
        $this->postModel = new Post($pdo);
    }

    // Method to display all posts
    public function index()
    {
        $posts = $this->postModel->getAllPosts(); // Fetch all posts from the model
        require __DIR__ . '/../views/posts/index.php'; // Load the view to display posts
    }

    // Method to create a new post
    public function create()
    {
        // Check if the request method is POST requests
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title']; // Get the title from the request
            $description = $_POST['description']; // Get the description from the request
            $user_id = $_SESSION['user_id']; // Get the user ID from the session

            $image = ''; // Initialize the image variable with empty value to re-use it 
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // Use  path for storing the image with name of uploaded image
                $imagePath = 'assets/images/' . basename($_FILES['image']['name']);
                
                // Move the uploaded file to the directory using built in functions(move_upload_file)
                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    // Save path in the database
                    $image = 'assets/images/' . basename($_FILES['image']['name']);
                } else {
                    // Check if theres error with image uploded then show this error msg
                    echo "Failed to upload image.";
                    exit();
                }
            }

            // Create a new post using the Post model
            $this->postModel->createPost($title, $description, $image, $user_id);
            header("Location: /"); // Redirect to the homepage after creating the post
            exit();
        }
        
        require __DIR__ . '/../views/posts/create.php'; // Load the view for creating a post
    }

    // Method to edit an existing post
    public function edit($post_id)
    {
        // Fetch the post by its ID
        $post = $this->postModel->getPostById($post_id);

        // Redirect to the homepage if the post doesn't exist
        if (!$post) {
            header("Location: /");
            exit();
        }

        // Check if the request method is POST requests
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title']; // Get the title from the request
            $description = $_POST['description']; // Get the description from the request

            $image = $post['image']; // Initialize the image with the current post image
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // Use  path for storing the image with name of uploaded image
                $imagePath = __DIR__ . '/../../assets/images/' . basename($_FILES['image']['name']);
                
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $image = 'assets/images/' . basename($_FILES['image']['name']); // Update image path
                } else {
                    // Check if theres error with image uploded then show this error msg
                    echo "Failed to upload image."; // Handle file upload error
                    exit();
                }
            }

            // Update the post using the Post model
            $this->postModel->updatePost($title, $description, $image, $post_id);
            header("Location: /post/" . $post_id); // Redirect to the post's detail page
            exit();
        }

        require __DIR__ . '/../views/posts/edit.php'; // Load the view for editing a post
    }

    // Method to delete a post
    public function delete($post_id)
    {
        // Fetch the post by its ID
        $post = $this->postModel->getPostById($post_id);
    
        // Check if the user has permission to delete the post
        if ($post['user_id'] != $_SESSION['user_id']) {
            header("Location: /"); // Redirect to the homepage if not authorized
            exit();
        }
    
        // Delete related comments first
        $this->postModel->deleteCommentsByPostId($post_id);
    
        // Then, delete the post
        $this->postModel->deletePost($post_id);
    
        header("Location: /"); // Redirect to the homepage after deleting the post
        exit();
    }
    
    // Method to display a single post
    public function show($post_id)
    {
        $post = $this->postModel->getPostById($post_id); // Fetch the post by its ID
        $comments = $this->postModel->getAllComments($post_id); // Fetch all comments for the post
        require __DIR__ . '/../views/posts/show.php'; // Load the view to display the post
    }

    // Method to create a comment on a post
    public function create_comment($postId)
    {
        // Check if the request method is POST and required fields are set
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id']) && isset($_POST['comment'])) {
            $userId = $_SESSION['user_id']; // Get the user ID from the session
            $comment = $_POST['comment']; // Get the comment from the request
    
            // Create a new comment using the Post model
            $this->postModel->create_comment($postId, $userId, $comment);
            header("Location: /post/" . $postId); // Redirect to the post's detail page
            exit();
        }
    
        echo "Invalid request."; // Output an error message for invalid requests
    }
}
