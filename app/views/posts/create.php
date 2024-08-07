<?php 
/*
this blog platform build by msustaf naseer for zainiq tasks 
its opensource code any one can access it in my github accounts
*/

require __DIR__ . '/../layouts/header.php'; 
?>

<h2>Create New Post</h2>

<form action="/post/create" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
