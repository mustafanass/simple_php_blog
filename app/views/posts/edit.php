<?php 
/*
this blog platform build by msustaf naseer for zainiq tasks 
its opensource code any one can access it in my github accounts
*/

require __DIR__ . '/../layouts/header.php'; 
?>

<h2>Edit Post</h2>

<form action="/post/edit/<?php echo $post['id']; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']; ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $post['description']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image" name="image">
        <img src="/<?php echo $post['image']; ?>" class="img-thumbnail mt-2" alt="Post Image" style="max-width: 200px;">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
