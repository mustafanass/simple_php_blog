<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Tasks</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="../../../../assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<div class="container">
    <header class="bg-primary text-white py-3">
        <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center">
            <a class="navbar-brand mb-0 h1 text-white" href="index.php" style="font-size: 2rem;">Blog Tasks</a>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark mt-2">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="btn btn-light text-primary" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light text-primary" href="/post/create">Create Post</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="btn btn-light text-primary" href="/logout">Logout (<?php echo ($_SESSION['username']); ?>)</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-light text-primary" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light text-primary" href="/login">Login</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="btn btn-light text-primary" href="/register">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        </div>
    </header>
    <div class="container mt-4">
