<?php
/*
This blog platform is built by Mustafa Naseer for Zainiq tasks.
It's open-source code, and anyone can access it on my GitHub account.
*/

class Post
{
    private $pdo;

    // Constructor to initialize the PDO connection
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Method to get all posts with their associated usernames, ordered by creation date
    public function getAllPosts()
    {
        $stmt = $this->pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
        $posts = $stmt->fetchAll(); // Fetch all the posts as an array
        return $posts;
    }

    // Method to create a new post in the database
    public function createPost($title, $description, $image, $user_id)
    {
        // Prepare and execute the SQL statement to insert a new post
        $stmt = $this->pdo->prepare("INSERT INTO posts (title, description, image, user_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $description, $image, $user_id]);
    }

    // Method to get a specific post by its ID
    public function getPostById($post_id)
    {
        // Prepare and execute the SQL statement to retrieve a post by its ID
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$post_id]);
        return $stmt->fetch(); // Return the fetched post
    }

    // Method to update an existing post in the database
    public function updatePost($title, $description, $image, $post_id)
    {
        // Prepare and execute the SQL statement to update a post
        $stmt = $this->pdo->prepare("UPDATE posts SET title = ?, description = ?, image = ? WHERE id = ?");
        $stmt->execute([$title, $description, $image, $post_id]);
    }

    // Method to delete a post by its ID
    public function deletePost($post_id)
    {
        // Prepare and execute the SQL statement to delete a post
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$post_id]);
    }

    // Method to delete all comments associated with a specific post
    public function deleteCommentsByPostId($post_id)
    {
        // Prepare and execute the SQL statement to delete comments by post ID
        $stmt = $this->pdo->prepare("DELETE FROM comments WHERE post_id = ?");
        $stmt->execute([$post_id]);
    }

    // Method to get the count of comments for a specific post
    public function getCommentCount($postId)
    {
        // Prepare and execute the SQL statement to count comments for a post
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM comments WHERE post_id = ?");
        $stmt->execute([$postId]);
        return $stmt->fetchColumn(); // Return the comment count
    }

    // Method to create a new comment for a specific post
    public function create_comment($postId, $userId, $comment)
    {
        // Prepare and execute the SQL statement to insert a new comment
        $stmt = $this->pdo->prepare("INSERT INTO comments (post_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$postId, $userId, $comment]);
    }

    // Method to retrieve all comments for a specific post, including the username of each commenter
    public function getAllComments($postId)
    {
        // Prepare and execute the SQL statement to retrieve comments and associated usernames
        $stmt = $this->pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY comments.created_at DESC");
        $stmt->execute([$postId]);
        return $stmt->fetchAll(); // Fetch all the comments as an array
    }
}
